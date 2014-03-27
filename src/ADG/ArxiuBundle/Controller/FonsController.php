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
    		$cercaTipus = $request->request->get('cercaTipus');
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
    		
    		if ($cercaTipus=="relaxada" || ($cercaNom=="" && $cercaLloc=="" && $cercaData=="")) {
    			$em = $this->getDoctrine()->getManager();
    			$rep = $em->getRepository('ArxiuBundle:FonsCapellans');
    		
    			$info=$rep->findForCapellans($cercaNom, $cercaLloc, $cercaData);
    		}
    		else{
    			$em = $this->getDoctrine()->getManager();
    			$rep = $em->getRepository('ArxiuBundle:FonsCapellans');
    		
    			$info=$rep->findForCapellansEstricta($cercaNom, $cercaLloc, $cercaData);
    		}
    	}    	
    	else if($tipus=="monges"){
    		//nom, lloc, congregacio
    		
    		if ($cercaTipus=="relaxada" || ($cercaNom=="" && $cercaLloc=="" && $cercaCongregacio=="")) {
    			$em = $this->getDoctrine()->getManager();
    			$rep = $em->getRepository('ArxiuBundle:FonsMonges');
    		
    			$info=$rep->findForMonges($cercaNom, $cercaLloc, $cercaCongregacio);
    		}
    		else{
    			$em = $this->getDoctrine()->getManager();
    			$rep = $em->getRepository('ArxiuBundle:FonsMonges');
    		
    			$info=$rep->findForMongesEstricta($cercaNom, $cercaLloc, $cercaCongregacio);
    		}
    		
    	}
    	else if($tipus=="seminaristes"){
    		//nom, data
    		
    		if ($cercaTipus=="relaxada" || ($cercaNom=="" && $cercaData=="")) {
    			$em = $this->getDoctrine()->getManager();
    			$rep = $em->getRepository('ArxiuBundle:FonsSeminaristes');
    		
    			$info=$rep->findForSeminaristes($cercaNom, $cercaData);
    		}
    		else{
    			$em = $this->getDoctrine()->getManager();
    			$rep = $em->getRepository('ArxiuBundle:FonsSeminaristes');
    		
    			$info=$rep->findForSeminaristesEstricta($cercaNom, $cercaData);
    		}
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
    		if($seleccio=="lletres") $info=$rep->findFonsLletres($cercaParaula);
    		if($seleccio=="llicencies") $info=$rep->findForFons("Q-", $cercaParaula);
    		if($seleccio=="registres") $info=$rep->findForFons("I-", $cercaParaula);
    		
    		if($seleccio=="manuals") $info=$rep->findFonsManuals($cercaParaula);
    		if($seleccio=="beneficis") $info=$rep->findFonsBeneficis($cercaParaula);
    		if($seleccio=="seu") $info=$rep->findFonsSeu($cercaParaula);
    		if($seleccio=="patronat") $info=$rep->findFonsPatronat($cercaParaula);
    		
    		if($seleccio=="notalarum") $info=$rep->findFonsNotalarum($cercaParaula);
    		if($seleccio=="deposita") $info=$rep->findFonsDeposita($cercaParaula);
    		
    		if($seleccio=="medievals") $info=$rep->findForFons("C-000-", $cercaParaula);
    		if($seleccio=="moderns") $info=$rep->findForFons("C-001-", $cercaParaula);
    		
    		if($seleccio=="delmes") $info=$rep->findForFons("R-000-", $cercaParaula);
    		
    	}
    	
    	return $this->render('ArxiuBundle:Fons:fons.html.twig',
    			array('seleccio' => $seleccio, 'tipus' => $tipus, 'cercaParaula'=>$cercaParaula, 
    					'cercaNom'=>$cercaNom, 'cercaLloc'=>$cercaLloc,'cercaData'=>$cercaData, 'cercaCongregacio'=>$cercaCongregacio, 'info' => $info)
    	);
    }
    
    public function detallAction($seleccio, $id)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	if($tipus=="fons"){
    		$rep = $em->getRepository('ArxiuBundle:Fons');
    		$info=$rep->find($id);
		}
		else if($tipus=="arxius"){
			$rep = $em->getRepository('ArxiuBundle:FonsArxius');
			$info=$rep->find($id);
		}
		else if($tipus=="mitra"){
			$rep = $em->getRepository('ArxiuBundle:FonsMitra');
			$info=$rep->find($id);
		}
		else if($tipus=="monges"){
			$rep = $em->getRepository('ArxiuBundle:FonsMonges');
			$info=$rep->find($id);
		}
		else if($tipus=="capellans"){
			$rep = $em->getRepository('ArxiuBundle:FonsCapellans');
			$info=$rep->find($id);
		}
		else if($tipus=="seminaristes"){
			$rep = $em->getRepository('ArxiuBundle:FonsSeminaristes');
			$info=$rep->find($id);
		}
		else if($tipus=="liberden"){
			$rep = $em->getRepository('ArxiuBundle:FonsLiberden');
			$info=$rep->find($id);
		}
		else if($tipus=="testaments"){
			$rep = $em->getRepository('ArxiuBundle:FonsTestaments');
			$info=$rep->find($id);
		}
		
		
    	//obtindra el tipus i el num o id en cas de liberden per pasar la info a mostrar
    	return $this->render('ArxiuBundle:Fons:detall.html.twig',
    			array('seleccio' => $seleccio,  'tipus' => $tipus, 'info' => $info)
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
    	elseif ($seleccio == "testaments" or $seleccio == "resolucions" or $seleccio == "definicions" or $seleccio == "instuicions"){
    		$tipus="testaments";
    	}
    	else{
    		$tipus="fons";
    	}
    	return $tipus;
    }
    
    
    
}
