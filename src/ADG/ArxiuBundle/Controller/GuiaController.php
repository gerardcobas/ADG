<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GuiaController extends Controller
{
    public function guiaAction()
    {
    	
    	$em = $this->getDoctrine()->getManager();
    	$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
    	 
    	$allFons = $repFons->findAll();

        return $this->render('ArxiuBundle:Guia:guia.html.twig',
    			array('allFons' => $allFons, 'currentId' => null, 'info' => null)
        );
    }
    
    public function searchAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$currentId = $id;
    	
    	$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
    	$allFons = $repFons->findAll();

    	$repSub = $em->getRepository('ArxiuBundle:GuiaSubfons');
    	$subFons = $repSub->findByLike($id);
    	
    	$repGrup = $em->getRepository('ArxiuBundle:GuiaGrup');
    	$grups = $repGrup->findByLike($id);
    	
    	$parts = explode('.', $id);
    	$tam=sizeof($parts);
    	$info=null;
    	if($tam==2){
    		$info=$repFons->find($id);
    	}
    	

    	return $this->render('ArxiuBundle:Guia:guia.html.twig',
    			array('info' => $info, 'allFons' => $allFons, 'currentId' => $currentId, 'subFons' => $subFons, 'grups' => $grups)
    	);
    }
    
    
}
