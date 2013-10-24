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
    	
    	//inicialitza variables
    	$info=null;
		$subFons=null;
		$grups=null;
		$series=null;
		$ucomps=null;
		$usims=null;
		$uinsts=null;
		
		//es divideix l'identificador indicat per saber a quin nivell es troba
    	$parts = explode('.', $id);
    	$tam=sizeof($parts);

    	//obtenir continguts del desplegable, en el moment que s'han de ensenyar
    	if($tam >= 2){
    		$repSub = $em->getRepository('ArxiuBundle:GuiaSubfons');
    		$subFons = $repSub->findByLike($id);
    	}
    	if($tam >= 3){
    		$repGrup = $em->getRepository('ArxiuBundle:GuiaGrup');
    		$grups = $repGrup->findByLike($id);
    	}
    	if($tam >= 4){
    		$repSerie = $em->getRepository('ArxiuBundle:GuiaSerie');
    		$series = $repSerie->findByLike($id);
    	}
    	if($tam >= 5){
    		$repUcomp = $em->getRepository('ArxiuBundle:GuiaUcomposta');
    		$ucomps = $repUcomp->findByLike($id);
    	}
    	if($tam >= 6){
    		$repUsim = $em->getRepository('ArxiuBundle:GuiaUsimple');
    		$usims = $repUsim->findByLike($id);
    	}	
    	if($tam >= 7){
    		$repUinst = $em->getRepository('ArxiuBundle:GuiaUinstalacio');
    		$uinsts = $repUinst->findByLike($id);
    	}
    	    	
    	//obtenir la informacio de cada seleccionat
    	if($tam==2){
    		$info=$repFons->find($id);
    	}
    	else if($tam==3){
    		$info=$repSub->find($id);
    	}
    	else if($tam==4){
    		$info=$repGrup->find($id);
    	}
    	else if($tam==5){
    		$info=$repSerie->find($id);
    	}
    	else if($tam==6){
    		$info=$repUcomp->find($id);
    	}
    	else if($tam==7){
    		$info=$repUsim->find($id);
    	}    	 
    	else if($tam==8){
    		$info=$repUinst->find($id);
    	}
    	
    	return $this->render('ArxiuBundle:Guia:guia.html.twig',
    			array('allFons' => $allFons, 'currentId' => $id, 'info' => $info, 'subFons' => $subFons, 
    					'grups' => $grups, 'series' => $series, 'ucomps' => $ucomps, 'usims' => $usims, 'uinsts' => $uinsts
    			)
    	);
    }
    
    
}
