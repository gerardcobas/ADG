<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\PrincipalBundle\Entity\User;

class AdminUsuarisController extends Controller
{
    
    public function usuarisAction() {
    	
		$userManager = $this->container->get('fos_user.user_manager');
    		
    	$usuaris = $userManager->findUsers();

    	return $this->render('PrincipalBundle:AdminUsuaris:usuaris.html.twig',
    			array('usuaris' => $usuaris));
    }
    
    
    /**
     * Obre formulari per afegir un nou usuari.
     */
    public function crearAction()
    {
    	return $this->render('PrincipalBundle:AdminUsuaris:crear.html.twig'
    	);
    }
   
    /**
     * Crea la nova entrada a partir de l'informacio del formulari.
     * Comprovarà si existeix en primer lloc usuari o l'email.
     */
    public function crearConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    
    		$userManager = $this->container->get('fos_user.user_manager');
    		
    		$user = $userManager->createUser();
    		
    		$usuari=$request->request->get('usuari');
    		$email=$request->request->get('email');
    		
    		$b1=self::existeixUsername($usuari);
    		if ($b1===true) {
    			$this->get('session')->getFlashBag()->add(
    					'error',
    					"Error! Ja existeix el nom d'usuari \"".$usuari."\" !"
    			);
    			return $this->redirect($this->generateUrl('admin_usuaris'));
    		}
    		$b2=self::existeixEmail($email);
    		if ($b2===true) {
    			$this->get('session')->getFlashBag()->add(
    					'error',
    					"Error! Ja existeix el email \"".$email."\" !"
    			);
    			return $this->redirect($this->generateUrl('admin_usuaris'));
    		}
    		
    		$user->setUsername($usuari);
    		$user->setEmail($email);
    		$user->setPlainPassword($request->request->get('contrasenya'));
    		$permis=$request->request->get('permis');
    		if ($permis == "gestor") {
    			$user->addRole("ROLE_ADMIN");
    		}
    		else{
    			$user->addRole("ROLE_USER");
    		}
    		$user->setEnabled(true);
    		
    		$userManager->updateCanonicalFields($user);
    		$userManager->updatePassword($user);
    		
    		$userManager->updateUser($user);
    		
    		$this->get('session')->getFlashBag()->add(
    			'success',
    			"Usuari \"".$usuari."\" afegit correctament!"
    		);
    
    	}
    	return $this->redirect($this->generateUrl('admin_usuaris'));
    }


    /**
     * Obre formulari per editar l'usuari indicat.
     */
    public function editarAction($usuari)
    {
		$userManager = $this->container->get('fos_user.user_manager');
    	$usuari = $userManager->findUserByUsername($usuari);
    	return $this->render('PrincipalBundle:AdminUsuaris:editar.html.twig',
    			array('usuari' => $usuari)
    	);
    }
    
    /**
     * Edita l'entitat original amb les modificacions fetes.
     * Comprovarà si existeix en primer lloc.
     */
    public function editarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    	
    		$usuari = $request->request->get('usuari');
    		
    		$userManager = $this->container->get('fos_user.user_manager');
    		$user = $userManager->findUserByUsername($usuari);
    		
    		$email = $request->request->get('email');
    		$contrasenya=$request->request->get('contrasenya');
    		$confirmar=$request->request->get('confirmar');
    		$emailOriginal = $request->request->get('emailOriginal');
			
    		if($confirmar!=$contrasenya){
    			$this->get('session')->getFlashBag()->add(
    					'error',
    					"Error! Les contrasenyes no coincideixen !"
    			);
    			return $this->redirect($this->generateUrl('admin_usuaris'));
    		}
    		
    		if($emailOriginal!=$email){
	    		$b=self::existeixEmail($email);
	    		if ($b===true) {
	    			$this->get('session')->getFlashBag()->add(
	    					'error',
	    					"Error! Ja existeix el email \"".$email."\" !"
	    			);
	    			return $this->redirect($this->generateUrl('admin_usuaris'));
	    		}
    		}
    		
    		$user->setEmail($email);
    		
    		if($contrasenya!="" && $contrasenya!=null) $user->setPlainPassword($contrasenya);
    		
    		$user->setEnabled(true);
    		$permis=$request->request->get('permis');
    		if ($permis == "gestor") {
    			$user->addRole("ROLE_ADMIN");
    		}
    		else if($permis == "usuari"){
    			$user->setRoles(array("ROLE_USER"));
    		}
    	
    		$userManager->updateCanonicalFields($user);
    		$userManager->updatePassword($user);
    	
    		$userManager->updateUser($user);
    	
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Usuari \"".$usuari."\" editat correctament!"
    		);
    	
    	}
    	return $this->redirect($this->generateUrl('admin_usuaris'));
    }

    /**
     * Obre formulari per eliminar l'usuari indicat.
     */
    public function eliminarAction($usuari)
    {
    	$userManager = $this->container->get('fos_user.user_manager');
    	$usuari = $userManager->findUserByUsername($usuari);
    	return $this->render('PrincipalBundle:AdminUsuaris:eliminar.html.twig',
    			array('usuari' => $usuari)
    	);
    }    
    
    /**
     * Elimina l'usuari indicat.
     */
    public function eliminarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		 
    		$usuari = $request->request->get('usuari');
    
    		$userManager = $this->container->get('fos_user.user_manager');
    		$user = $userManager->findUserByUsername($usuari);
    
    		$userManager->deleteUser($user);
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Usuari \"".$usuari."\" eliminat correctament!"
    		);
    		 
    	}
    	return $this->redirect($this->generateUrl('admin_usuaris'));
    }
    
    
    /**
     * Comprova si existeix algun usuari amb el mateix nom d'usuari
     */
    private function existeixUsername($username){
    
    	$userManager = $this->container->get('fos_user.user_manager');
    	$us=$userManager->findUserByUsername($username);
    
		if($us === null){
    		return false;
    	}
    	return true;
    }
    
    /**
     * Comprova si existeix algun usuari amb el mateix email
     */
    private function existeixEmail($email){
    
    	$userManager = $this->container->get('fos_user.user_manager');
    	$us=$userManager->findUserByEmail($email);
    
    	if($us === null){
    		return false;
    	}
    	return true;
    }
    
    
}
