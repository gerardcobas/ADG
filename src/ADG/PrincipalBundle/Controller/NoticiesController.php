<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\PrincipalBundle\Entity\User;

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
   
    
}
