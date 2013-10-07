<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function arxiuAction()
    {
        return $this->render('ArxiuBundle:Default:arxiu.html.twig');
    }
}
