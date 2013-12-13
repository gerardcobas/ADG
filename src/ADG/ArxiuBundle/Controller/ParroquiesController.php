<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParroquiesController extends Controller
{
    public function parroquiesAction()
    {
        return $this->render('ArxiuBundle:Parroquies:parroquies.html.twig',
    		array('info'=>null)	
        );
    }
    
}
