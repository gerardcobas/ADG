<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\ArxiuBundle\Entity\Fons;
use Adg\ArxiuBundle\Entity\FonsArxius;


class AdminFonsController extends Controller
{
    /**
     * Obre formulari per afegir un nou Fons del mateix tipus que la seleccio.
     */
    public function nouAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);
    	return $this->render('PrincipalBundle:AdminFons:nou.html.twig',
    		array('seleccio'=> $seleccio, 'tipus' => $tipus)
    	);
    }
    
    public function nouConfirmarAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=null;
    	 
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		
    		$em = $this->getDoctrine()->getManager();
    		$entity= self::creaEntitat($tipus);
    		$nodac = $request->request->get('inputNodac');
    		$entity->setNodac($nodac);
    		
    		if ($tipus=="arxius") {
    			$nouId= self::obteNouId($seleccio);
    			$entity->setNum($nouId);
    		}
    
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->redirect($this->generateUrl('fons_select', array('seleccio' => $seleccio)));
    }

    public function editarAction($seleccio, $id)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=null;
    	 
    	return $this->render('PrincipalBundle:AdminFons:editar.html.twig',
    			array('info' => $info, 'seleccio'=> $seleccio)
    	);
    }
    
    public function eliminarAction($seleccio, $id)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=null;
    	
    	return $this->render('PrincipalBundle:AdminFons:eliminar.html.twig',
    		array('info' => $info, 'seleccio'=> $seleccio)
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
    
    /**
     * Crea una entitat buida com la del indentificador donat.
     */
    private function creaEntitat($tipus){
    	$entitat=null;
    	if($tipus=="fons"){
			$entitat = new Fons();
		}
		else if($tipus=="arxius"){
			$entitat = new FonsArxius();
		}
		else if($tipus=="mitra"){
			$entitat = new FonsMitra();
		}
		else if($tipus=="monges"){
			$entitat = new FonsMonges();
		}
		else if($tipus=="capellans"){
			$entitat = new FonsCapellans();
		}
		else if($tipus=="seminaristes"){
			$entitat = new FonsSeminaristes();
		}
		else if($tipus=="liberden"){
			$entitat = new FonsLiberden();
		}
		else if($tipus=="testaments"){
			$entitat = new FonsTestaments();
		}
    	return $entitat;
    }
    
    /**
     * Crea una entitat buida com la del indentificador donat.
     */
    private function obteNouId($seleccio){
    	$em = $this->getDoctrine()->getManager();
    	$nouId=null;
    	if($seleccio=="curia") {
    		$rep = $em->getRepository('ArxiuBundle:FonsArxius');
    		$nouId=$rep->findNewId("P-001-");
    	}
    	return $nouId;
    }
    
}
