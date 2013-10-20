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
    	->render('PrincipalBundle:Admin:noticies.html.twig',
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
    		
    		
    		
    		return $this->redirect($this->generateUrl('admin'));
    		
    	}

    	return $this
    	->render('PrincipalBundle:Admin:noticies.html.twig',
    			array('noticies' => null, 'search' => null));

    }
   
    
}
