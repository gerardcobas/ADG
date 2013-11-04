<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\PrincipalBundle\Entity\User;

class AdminFonsController extends Controller
{
    /**
     * Obre formulari per afegir un nou usuari.
     */
    public function nouAction($seleccio)
    {
    	return $this->render('PrincipalBundle:AdminFons:nou.html.twig'
    	);
    }

    public function editarAction($seleccio, $id)
    {
    	return $this->render('PrincipalBundle:AdminFons:editar.html.twig'
    	);
    }
    
    public function eliminarAction($seleccio, $id)
    {
    	return $this->render('PrincipalBundle:AdminFons:eliminar.html.twig'
    	);
    }
    
}
