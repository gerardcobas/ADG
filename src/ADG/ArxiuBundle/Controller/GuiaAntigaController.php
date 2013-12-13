<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GuiaAntigaController extends Controller
{
    public function guiaAntigaAction($seleccio)
    {
        return $this->render('ArxiuBundle:GuiaAntiga:guiaAntiga.html.twig',
    			array('seleccio' => $seleccio)
        );
    }
}
