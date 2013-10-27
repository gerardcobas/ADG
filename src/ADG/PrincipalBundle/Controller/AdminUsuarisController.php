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
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$rep = $em->getRepository('PrincipalBundle:User');
    	$usuaris = $rep->findAll();

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
    		
    		$user->setUsername('John');
    		$user->setEmail('john.doe@example.com');
    		$user->setPlainPassword("john");
    		
    		$userManager->updateCanonicalFields($user);
    		$userManager->updatePassword($user);
    		$userManager->setEnabled(true);
    		
    		$userManager->updateUser($user);
    		
    		$this->get('session')->getFlashBag()->add(
    			'success',
    			"Entrada afegida correctament!"
    		);
    
    	}
    	return $this->redirect($this->generateUrl('admin_usuaris'));
    }
    
    
}
