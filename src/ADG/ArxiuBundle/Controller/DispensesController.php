<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DispensesController extends Controller
{
    public function dispensesAction()
    {
        return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    		array('seleccio'=>'dispenses')	
        );
    }
    
    
    
}
