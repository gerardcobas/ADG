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

    	$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
    	$allFons = $repFons->findAll();
		$subFons=null;
		$grups=null;
		
    	$parts = explode('.', $id);
    	$tam=sizeof($parts);
    	$info=null;

    	if($tam >= 2){
    		$repSub = $em->getRepository('ArxiuBundle:GuiaSubfons');
    		$subFons = $repSub->findByLike($id);
    		if($tam==2){
    			$info=$repFons->find($id);
    		}
    		else if($tam==3){
    			$info=$repSub->find($id);
    		}
    	}
    	if($tam >= 3){
    		$repGrup = $em->getRepository('ArxiuBundle:GuiaGrup');
    		$grups = $repGrup->findByLike($id);
    		if($tam==4){
    			$info=$repGrup->find($id);
    		}
    	}
    	



    	return $this->render('ArxiuBundle:Guia:guia.html.twig',
    			array('info' => $info, 'allFons' => $allFons, 'currentId' => $id, 'subFons' => $subFons, 'grups' => $grups)
    	);
    }
    
    
}
