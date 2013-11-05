<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\ArxiuBundle\Entity\Fons;
use Adg\ArxiuBundle\Entity\FonsArxius;
use Adg\ArxiuBundle\Entity\FonsCapellans;
use Adg\ArxiuBundle\Entity\FonsMitra;
use Adg\ArxiuBundle\Entity\FonsLiberden;
use Adg\ArxiuBundle\Entity\FonsMonges;
use Adg\ArxiuBundle\Entity\FonsSeminaristes;
use Adg\ArxiuBundle\Entity\FonsTestaments;


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
    
    /**
     * Crea la nova entrada a partir de l'informacio del formulari.
     */
    public function nouConfirmarAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=null;
    	 
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		
    		$em = $this->getDoctrine()->getManager();
    		$entity= self::creaEntitat($tipus);
    		
    		//atributs comuns
    		if ($tipus!="liberden") {
	    		$nouId= self::obteNouId($seleccio, $tipus);
	    		$entity->setNum($nouId);
    		}
    		$nodac = $request->request->get('inputNodac');
    		$entity->setNodac($nodac);
    		
    		//atributs segons el tipus
    		if ($tipus=="arxius") {
    			$entity->setData($request->request->get('inputData'));
    			$entity->setDades($request->request->get('inputDades'));
    			$entity->setNotari($request->request->get('inputNotari'));
    			$entity->setMides($request->request->get('inputMides'));
    			$entity->setObs($request->request->get('inputObs'));
    		}
    		else if($tipus=="capellans"){
    			$entity->setDataNaixement($request->request->get('inputData'));
    			$entity->setCognom($request->request->get('inputNom'));
    			$entity->setNaturalDe($request->request->get('inputNatural'));
    			$entity->setOrdenacio($request->request->get('inputOrdenacio'));
    			$entity->setDataObit($request->request->get('inputDataObit'));
    			$entity->setAltres($request->request->get('inputAltres'));
    			$entity->setFitxa($request->request->get('inputFitxa'));
    		}
    		else if($tipus=="monges"){
    			$entity->setData($request->request->get('inputData'));
    			$entity->setCognom($request->request->get('inputNom'));
    			$entity->setNaturalDe($request->request->get('inputNatural'));
    			$entity->setCongregacio($request->request->get('inputCongregacio'));
    			$entity->setLlocCongregacio($request->request->get('inputLloc'));
    			$entity->setFitxa($request->request->get('inputFitxa'));
    		}
    		else if($tipus=="seminaristes"){
    			$entity->setData($request->request->get('inputData'));
    			$entity->setCognom($request->request->get('inputNom'));
    		}
    		else if($tipus=="liberden"){
    			$entity->setInstitucio($request->request->get('inputInstitucio'));
    			$entity->setFoli($request->request->get('inputFoli'));
    		}
    		else if($tipus=="mitra"){
    			$entity->setData($request->request->get('inputData'));
    			$entity->setDades($request->request->get('inputDades'));
    			$entity->setNotari($request->request->get('inputNotari'));
    			$entity->setMides($request->request->get('inputMides'));
    			$entity->setObs($request->request->get('inputObs'));
    		}
    		else if($tipus=="testaments"){
    			$entity->setDades($request->request->get('inputDades'));
    		}
    		else if($tipus=="fons"){
    			$entity->setDades($request->request->get('inputDades'));
    			$entity->setLlibre($request->request->get('inputLlibre'));
    			$entity->setFull($request->request->get('inputFull'));
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

    /**
     * Obre formulari per editar el fons seleccoionat.
     */
    public function editarAction($seleccio, $id)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=self::obteInfo($id, $tipus);
    	 
    	return $this->render('PrincipalBundle:AdminFons:editar.html.twig',
    			array('info' => $info, 'seleccio'=> $seleccio, 'tipus'=>$tipus)
    	);
    }
    
    /**
     * Edita l'entrada seleccionada partir de l'informacio del formulari.
     */
    public function editarConfirmarAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);

    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    
    		$id = $request->request->get('id');
    		$entity=self::obteInfo($id, $tipus);
    		
    		$entity->setNodac($request->request->get('inputNodac'));
    
    		//atributs segons el tipus
    		if ($tipus=="arxius") {
    			$entity->setData($request->request->get('inputData'));
    			$entity->setDades($request->request->get('inputDades'));
    			$entity->setNotari($request->request->get('inputNotari'));
    			$entity->setMides($request->request->get('inputMides'));
    			$entity->setObs($request->request->get('inputObs'));
    		}
    		else if($tipus=="capellans"){
    			$entity->setDataNaixement($request->request->get('inputData'));
    			$entity->setCognom($request->request->get('inputNom'));
    			$entity->setNaturalDe($request->request->get('inputNatural'));
    			$entity->setOrdenacio($request->request->get('inputOrdenacio'));
    			$entity->setDataObit($request->request->get('inputDataObit'));
    			$entity->setAltres($request->request->get('inputAltres'));
    			$entity->setFitxa($request->request->get('inputFitxa'));
    		}
    		else if($tipus=="monges"){
    			$entity->setData($request->request->get('inputData'));
    			$entity->setCognom($request->request->get('inputNom'));
    			$entity->setNaturalDe($request->request->get('inputNatural'));
    			$entity->setCongregacio($request->request->get('inputCongregacio'));
    			$entity->setLlocCongregacio($request->request->get('inputLloc'));
    			$entity->setFitxa($request->request->get('inputFitxa'));
    		}
    		else if($tipus=="seminaristes"){
    			$entity->setData($request->request->get('inputData'));
    			$entity->setCognom($request->request->get('inputNom'));
    		}
    		else if($tipus=="liberden"){
    			$entity->setInstitucio($request->request->get('inputInstitucio'));
    			$entity->setFoli($request->request->get('inputFoli'));
    		}
    		else if($tipus=="mitra"){
    			$entity->setData($request->request->get('inputData'));
    			$entity->setDades($request->request->get('inputDades'));
    			$entity->setNotari($request->request->get('inputNotari'));
    			$entity->setMides($request->request->get('inputMides'));
    			$entity->setObs($request->request->get('inputObs'));
    		}
    		else if($tipus=="testaments"){
    			$entity->setDades($request->request->get('inputDades'));
    		}
    		else if($tipus=="fons"){
    			$entity->setDades($request->request->get('inputDades'));
    			$entity->setLlibre($request->request->get('inputLlibre'));
    			$entity->setFull($request->request->get('inputFull'));
    		}
    
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha editat correctament!"
    		);
    	}
    	return $this->redirect($this->generateUrl('fons_select', array('seleccio' => $seleccio)));
    }
    
    
    
    /**
     * Obre formulari per eliminar el fons seleccoionat.
     */
    public function eliminarAction($seleccio, $id)
    {
    	$tipus=self::obteTipus($seleccio);
    	$info=self::obteInfo($id, $tipus);
    	
    	return $this->render('PrincipalBundle:AdminFons:eliminar.html.twig',
    		array('info' => $info, 'seleccio'=> $seleccio, 'tipus'=>$tipus)
    	);
    }
    
    
    /**
     * Elimina l'entrada seleccionada.
     */
    public function eliminarConfirmarAction($seleccio)
    {
    	$tipus=self::obteTipus($seleccio);
    	$request = $this->getRequest();
    	
    	if ($request->isMethod('POST')) {
    
    		$id = $request->request->get('id');
    		$entity=self::obteInfo($id, $tipus);
    			
    		$em = $this->getDoctrine()->getManager();
    		$em->remove($entity);
    		$em->flush();
    			
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha eliminat correctament!"
    		);
    	}
    	return $this->redirect($this->generateUrl('fons_select', array('seleccio' => $seleccio)));
    }
    
    
/** --------- Privades ---------- */
    
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
    	
    	if($tipus=="fons") $entitat = new Fons();
		else if($tipus=="arxius") $entitat = new FonsArxius();
		else if($tipus=="mitra") $entitat = new FonsMitra();
		else if($tipus=="monges") $entitat = new FonsMonges();
		else if($tipus=="capellans") $entitat = new FonsCapellans();
		else if($tipus=="seminaristes") $entitat = new FonsSeminaristes();
		else if($tipus=="liberden") $entitat = new FonsLiberden();
		else if($tipus=="testaments") $entitat = new FonsTestaments();
		
    	return $entitat;
    }
    
    /**
     * Crea una entitat buida com la del indentificador donat.
     */
    private function obteNouId($seleccio, $tipus){
    	$em = $this->getDoctrine()->getManager();
    	
    	$nouId=null;
    	$rep = null;
    	
    	//obtenir repositoris
    	if($tipus=="fons") $rep = $em->getRepository('ArxiuBundle:Fons');
		else if($tipus=="arxius") $rep = $em->getRepository('ArxiuBundle:FonsArxius');
		else if($tipus=="mitra") $rep = $em->getRepository('ArxiuBundle:FonsMitra');
		else if($tipus=="monges") $rep = $em->getRepository('ArxiuBundle:FonsMonges');
		else if($tipus=="capellans") $rep = $em->getRepository('ArxiuBundle:FonsCapellans');
		else if($tipus=="seminaristes")$rep = $em->getRepository('ArxiuBundle:FonsSeminaristes');
		else if($tipus=="testaments") $rep = $em->getRepository('ArxiuBundle:FonsTestaments');
    	
		//obte ids
    	//lletres
    	if($seleccio=="lletres") $nouId=$rep->findNewId("U-001-"); 
    	if($seleccio=="llicencies") $nouId=$rep->findNewId("Q-001-");
    	if($seleccio=="registres") $nouId=$rep->findNewId("I-001-");
    	
    	//manuals
    	if($seleccio=="manuals") $nouId=$rep->findNewId("D-1");
    	if($seleccio=="beneficis") $nouId=$rep->findNewId("D-001-");
    	if($seleccio=="seu") $nouId=$rep->findNewId("D-002-"); 
    	if($seleccio=="patronat") $nouId=$rep->findNewId("A-");
    	    	
    	//arxius
    	if($seleccio=="curia") $nouId=$rep->findNewId("P-001-");
    	if($seleccio=="almoina") $nouId=$rep->findNewId("P-002-");
    	if($seleccio=="stfeliu") $nouId=$rep->findNewId("P-003-");
    	if($seleccio=="besalu") $nouId=$rep->findNewId("P-004-");
    	if($seleccio=="llado") $nouId=$rep->findNewId("P-005-");
    	if($seleccio=="cadins") $nouId=$rep->findNewId("P-006-");
    	
    	//notaria
    	if($seleccio=="notalarum") $nouId=$rep->findNewId("G-001-"); 
    	if($seleccio=="deposita") $nouId=$rep->findNewId("U-3");
    	 
    	//ordes
    	if($seleccio=="capellans") $nouId=$rep->findNewId("R-001-"); 
    	if($seleccio=="monges") $nouId=$rep->findNewId("R-002-"); 
    	if($seleccio=="seminaristes") $nouId=$rep->findNewId("R-003-"); 

    	//testaments
    	if($seleccio=="testaments") $nouId=$rep->findNewId("T-001-"); 
    	if($seleccio=="definicions")$nouId=$rep->findNewId("T-002-");
    	if($seleccio=="resolucions") $nouId=$rep->findNewId("T-003-");
    	if($seleccio=="instuicions") $nouId=$rep->findNewId("T-004-");
    	
    	//processos
    	if($seleccio=="medievals") $nouId=$rep->findNewId("C-000-");
    	if($seleccio=="moderns") $nouId=$rep->findNewId("C-001-");
    	
    	//mitra
    	if($seleccio=="mitra") $nouId=$rep->findNewId("P-004-");
    	if($seleccio=="delmes") $nouId=$rep->findNewId("R-000-");
    	
    	return $nouId;
    }
    
    
    private function obteInfo($id, $tipus){
    	$info = null;
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
    	return $info;
    }
    
}
