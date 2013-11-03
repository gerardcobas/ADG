<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FonsController extends Controller
{
    public function fonsAction()
    {
        return $this->render('ArxiuBundle:Fons:fons.html.twig',
    			array('seleccio' => null, 'info' => null)
        );
    }
    
    public function selectAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=null;
    	//obtenir tota la taula de monges / capellans / seminaristes
    	if ($tipus=="capellans") {
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsCapellans');
    		$info=$rep->findAll();
    	}
    	elseif ($tipus=="monges") {
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsMonges');
    		$info=$rep->findAll();
    	}
    	elseif ($tipus=="seminaristes") {
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsSeminaristes');
    		$info=$rep->findAll();
    	}
    	
    	return $this->render('ArxiuBundle:Fons:fons.html.twig',
    			array('seleccio' => $seleccio, 'tipus' => $tipus, 'cercaParaula'=>null, 
    					'cercaNom'=>null, 'cercaLloc'=>null,'cercaData'=>null,'cercaCongregacio'=>null, 'info' => $info)
    	);
    }

    public function cercarAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);
    	
    	//select cercas i retornarles
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$cercaParaula = $request->request->get('cercaParaula');
    		$cercaNom = $request->request->get('cercaNom');
    		$cercaLloc = $request->request->get('cercaLloc');
    		$cercaData = $request->request->get('cercaData');
    		$cercaCongregacio = $request->request->get('cercaCongregacio');
    	}
    	
    	$info=null;
    	
    	//mirar ifs de $tipus per escollir el repository
    	//??dins irar kines estan plenes per fer cerca BD -> pot ferho repo ncara k el atribut sigui buit!
    	//mirar ifs $seleccio per pasar a repo el format de num "P-001" que toki
    	
    	if ($tipus=="arxius") {
    		//cerca amb data i paraula
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsArxius');
    		
    		if($seleccio=="curia") $info=$rep->findForArxius("P-001-", $cercaParaula, $cercaData);
    		if($seleccio=="almoina") $info=$rep->findForArxius("P-002-", $cercaParaula, $cercaData);
    		if($seleccio=="stfeliu") $info=$rep->findForArxius("P-003-", $cercaParaula, $cercaData);
    		if($seleccio=="besalu") $info=$rep->findForArxius("P-004-", $cercaParaula, $cercaData);
    		if($seleccio=="llado") $info=$rep->findForArxius("P-005-", $cercaParaula, $cercaData);
    		if($seleccio=="cadins") $info=$rep->findForArxius("P-006-", $cercaParaula, $cercaData);
    	}
    	else if($tipus=="capellans"){
    		//nom, lloc, data
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsCapellans');
    		
    		$info=$rep->findForCapellans($cercaNom, $cercaLloc, $cercaData);
    	}    	
    	else if($tipus=="monges"){
    		//nom, lloc, congregacio
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsMonges');
    		
    		$info=$rep->findForMonges($cercaNom, $cercaLloc, $cercaCongregacio);
    	}
    	else if($tipus=="seminaristes"){
    		//nom, data
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsSeminaristes');
    		
    		$info=$rep->findForSeminaristes($cercaNom, $cercaData);
    	}    	    	
    	else if($tipus=="liberden"){
    		//paraula
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsLiberden');
    		
    		$info=$rep->findForLiberden($cercaParaula);
    	}
    	else if($tipus=="mitra"){
    		//paraula
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsMitra');
    		
    		$info=$rep->findForMitra($cercaParaula);
    	}
    	else if($tipus=="testaments"){
    		//paraula
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:FonsTestaments');
    		
    		if($seleccio=="testaments") $info=$rep->findForTestaments("T-001-", $cercaParaula);
    		if($seleccio=="definicions") $info=$rep->findForTestaments("T-002-", $cercaParaula);
    		if($seleccio=="resolucions") $info=$rep->findForTestaments("T-003-", $cercaParaula);
    		if($seleccio=="instuicions") $info=$rep->findForTestaments("T-004-", $cercaParaula);
    	}
    	else if($tipus=="fons"){
    		//paraula
    		
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:Fons');
    		
    		//Comprovar la seleccio i buscar en funcio del prefix fixat per l'arxiu
    		if($seleccio=="lletres") $info=$rep->findForFons("U-001-", $cercaParaula);
    		if($seleccio=="llicencies") $info=$rep->findForFons("Q-001-", $cercaParaula);
    		if($seleccio=="registres") $info=$rep->findForFons("I-001-", $cercaParaula);
    		
    		if($seleccio=="manuals") $info=$rep->findForFons("D-1", $cercaParaula);
    		if($seleccio=="beneficis") $info=$rep->findForFons("D-001-", $cercaParaula);
    		if($seleccio=="seu") $info=$rep->findForFons("D-002-", $cercaParaula);
    		if($seleccio=="patronat") $info=$rep->findForFons("A-", $cercaParaula);
    		
    		if($seleccio=="notalarum") $info=$rep->findForFons("G-001-", $cercaParaula);
    		if($seleccio=="deposita") $info=$rep->findForFons("U-3", $cercaParaula);
    		
    		if($seleccio=="medievals") $info=$rep->findForFons("C-000-", $cercaParaula);
    		if($seleccio=="moderns") $info=$rep->findForFons("C-001-", $cercaParaula);
    		
    		if($seleccio=="delmes") $info=$rep->findForFons("R-000-", $cercaParaula);
    		
    	}
    	
    	return $this->render('ArxiuBundle:Fons:fons.html.twig',
    			array('seleccio' => $seleccio, 'tipus' => $tipus, 'cercaParaula'=>$cercaParaula, 
    					'cercaNom'=>$cercaNom, 'cercaLloc'=>$cercaLloc,'cercaData'=>$cercaData, 'cercaCongregacio'=>$cercaCongregacio, 'info' => $info)
    	);
    }
    
    public function detallAction($tipus, $id)
    {
    	
    	//obtindra el tipus i el num o id en cas de liberden per pasar la info a mostrar
    	return $this->render('ArxiuBundle:Fons:detall.html.twig',
    			array('tipus' => $tipus, 'info' => null)
    	);
    }
    
    
    
    /**
     * Calcula el tipus a partir de la seleccio
     */
    private function obteTipus($seleccio){
   		$tipus=null;
    	if ($seleccio == "curia" or $seleccio == "almoina" or $seleccio == "stfeliu" or $seleccio == "besalu" or $seleccio == "llado" or $seleccio == "cadins") {
    		$tipus="arxius";
    	}
    	elseif ($seleccio == "mitra"){
    		$tipus="mitra";
    	}
    	elseif ($seleccio == "liberden"){
    		$tipus="liberden";
    	}
    	elseif ($seleccio == "capellans"){
    		$tipus="capellans";
    	}
    	elseif ($seleccio == "monges"){
    		$tipus="monges";
    	}
    	elseif ($seleccio == "seminaristes"){
    		$tipus="seminaristes";
    	}
    	elseif ($seleccio == "testaments" or $seleccio == "resolucions" or $seleccio == "definicions" or $seleccio == "definicions"){
    		$tipus="testaments";
    	}
    	else{
    		$tipus="fons";
    	}
    	return $tipus;
    }
    
    
    
}
