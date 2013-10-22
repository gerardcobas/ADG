<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GuiaController extends Controller
{
    public function guiaAction()
    {
        return $this->render('ArxiuBundle:Guia:guia.html.twig');
    }

}
