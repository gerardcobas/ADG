<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    
}
