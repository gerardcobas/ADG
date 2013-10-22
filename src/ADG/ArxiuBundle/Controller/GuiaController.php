<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GuiaController extends Controller
{
    public function guiaAction()
    {
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
    	 
    	$allFons = $repFons->findAll();

        return $this->render('ArxiuBundle:Guia:guia.html.twig',
    			array('allFons' => $allFons, 'currentId' => null)
        );
    }
    
    public function fonsAction($fons)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$currentId = $fons;
    	
    	$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
    	$allFons = $repFons->findAll();
    	
    	$repSub = $em->getRepository('ArxiuBundle:GuiaSubfons');
    	$subFons = $repSub->findByLike($fons);

    	return $this->render('ArxiuBundle:Guia:guia.html.twig',
    			array('allFons' => $allFons, 'currentId' => $currentId, 'subFons' => $subFons)
    	);
    }
    
    
    public function subAction($selSub)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	 
    	$currentId = $selSub;
    	 
    	$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
    	$allFons = $repFons->findAll();
    	
    	$repSub = $em->getRepository('ArxiuBundle:GuiaSubfons');
    	$subFons = $repSub->findByLike($fons);
    
    	return $this->render('ArxiuBundle:Guia:guia.html.twig',
    			array('allFons' => $allFons, 'currentId' => $currentId, 'subFons' => $subFons)
    	);
    }
    
    
}
