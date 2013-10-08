<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\PrincipalBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrincipalBundle:Default:index.html.twig');
    }
    
    public function contacteAction() {
    	return $this->render('PrincipalBundle:Default:contacte.html.twig');
    }

    public function normativaAction() {
    	return $this->render('PrincipalBundle:Default:normativa.html.twig');
    }
    
    public function capitularAction() {
    	return $this->render('PrincipalBundle:Default:capitular.html.twig');
    }
    
    public function loginAction() {
    	$peticion = $this->getRequest();
    	$sesion = $peticion->getSession();
    
    	$error = $peticion->attributes
    	->get(SecurityContext::AUTHENTICATION_ERROR,
    			$sesion->get(SecurityContext::AUTHENTICATION_ERROR));
    
    	return $this
    	->render('PrincipalBundle:Default:login.html.twig',
    			array('last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
    					'error' => $error));
    }
    
  
    
}
