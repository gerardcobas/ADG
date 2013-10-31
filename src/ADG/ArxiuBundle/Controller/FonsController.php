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
    	
    	//obtenir tota la taula en arxius / monges / capellans / seminas
    	
    	return $this->render('ArxiuBundle:Fons:fons.html.twig',
    			array('seleccio' => $seleccio, 'tipus' => $tipus, 'cercaParaula'=>null, 
    					'cercaNom'=>null, 'cercaLloc'=>null,'cercaData'=>null,'info' => null)
    	);
    }

    public function cercarAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);
    	//select cercas i retornarles
    	
    	//mirar kines estan plenes i fer cerca a BD
    	
    	return $this->render('ArxiuBundle:Fons:fons.html.twig',
    			array('seleccio' => $seleccio, 'tipus' => $tipus, 'cercaParaula'=>null, 
    					'cercaNom'=>null, 'cercaLloc'=>null,'cercaData'=>null, 'info' => null)
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
