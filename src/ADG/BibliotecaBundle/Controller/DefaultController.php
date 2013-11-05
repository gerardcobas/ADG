<?php

namespace ADG\BibliotecaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ADGBibliotecaBundle:Default:index.html.twig');
    }
}
