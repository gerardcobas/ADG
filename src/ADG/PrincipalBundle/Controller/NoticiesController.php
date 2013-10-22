<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\PrincipalBundle\Entity\Noticies;

class NoticiesController extends Controller
{
    public function indexAction() {
    	
    	$peticion = $this->getRequest();
    	$search = $peticion->query->get('search');
    	$param = $peticion->query->get('param');
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$rep = $em->getRepository('PrincipalBundle:Noticies');
    	
    	if (null == $search) {
    		$noticies = $rep->findAll();
    	} else {
    		$noticies = $rep->findByParamFuzzy($param, $search);
    	}
    	
    	return $this
    	->render('PrincipalBundle:AdminNoticies:noticies.html.twig',
    			array('noticies' => $noticies, 'search' => $search));
    }
    
    /**
     * Crea nova entitat de Noticies.
     *
     */
    public function crearAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$titol = $request->request->get('titol');
    		$contingut = $request->request->get('contingut');
    		
    		$entity= new Noticies();
    		
    		$entity->setData(new \DateTime());
    		
    		$entity->setTitol($titol);
    		$entity->setContingut($contingut);
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
			
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Notícia afegida!"
    		);
    		
    		return $this->redirect($this->generateUrl('noticies_index'));
    		
    	}
    	return $this->redirect($this->generateUrl('noticies_index'));
    }
   
    /**
     * Mostra formulari per editar una Noticia
     *
     */
    public function editarAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$noticiaEditable = $em->getRepository('PrincipalBundle:Noticies')->find($id);
    
    	if (!$noticiaEditable) {
    		throw $this->createNotFoundException("No s'ha trobat");
    	}
    	
    	

    	return $this->render('PrincipalBundle:AdminNoticies:editarNoticies.html.twig',
    			array('noticiaEditable' => $noticiaEditable));
    }
    
    /**
     * Actualitza la noticia seleccionada.
     *
     */
    public function actualitzarAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$noticiaEditable = $em->getRepository('PrincipalBundle:Noticies')->find($id);
    	
    	if (!$noticiaEditable) {
    		throw $this->createNotFoundException("No s'ha trobat");
    	}
    	
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$titolEditar = $request->request->get('titolEditar');
    		$contingutEditar = $request->request->get('contingutEditar');
    		
    		$noticiaEditable->setData(new \DateTime());
    		
    		$noticiaEditable->setTitol($titolEditar);
    		$noticiaEditable->setContingut($contingutEditar);
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($noticiaEditable);
    		$em->flush();
    		
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Notícia actualitzada!"
    		);

    		return $this->redirect($this->generateUrl('noticies_index'));
    		
    	}
    	return $this->redirect($this->generateUrl('noticies_index'));
    }
    
    
    /**
     * Mostra formulari per eliminar una Noticia
     *
     */
    public function eliminarAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$noticia = $em->getRepository('PrincipalBundle:Noticies')->find($id);
    
    	if (!$noticia) {
    		throw $this->createNotFoundException("No s'ha trobat");
    	}
    
    	return $this->render('PrincipalBundle:AdminNoticies:eliminarNoticies.html.twig',
    			array('noticia' => $noticia));
    }    
    
    /**
     * Confirma l'eliminació de la noticia seleccionada.
     *
     */
    public function confirmAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$noticia = $em->getRepository('PrincipalBundle:Noticies')->find($id);
    	if (!$noticia) {
    		throw $this->createNotFoundException("No s'ha trobat");
    	}
		$em->remove($noticia);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add(
        		'success',
        		"Notícia eliminada!"
        );
        
    	return $this->redirect($this->generateUrl('noticies_index'));
    }
    
    
}
