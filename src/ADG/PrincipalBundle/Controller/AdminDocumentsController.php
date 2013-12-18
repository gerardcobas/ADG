<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use ADG\ArxiuBundle\Entity\Documents;
use ADG\ArxiuBundle\Entity\DocumentsAdlimina;

class AdminDocumentsController extends Controller
{
    public function nouAction($seleccio)
    {
    	return $this->render('PrincipalBundle:AdminDocuments:nou.html.twig',
    		array('seleccio' => $seleccio)
    	);
    }
    
    public function nouConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();

    		$poblacio = $request->request->get('inputSeleccio');
    		$p='';
    		if ($poblacio == "carlemany") $p = "Cartoral de Carlemany";
    		elseif ($poblacio == "organya") $p = "Organya";
    		elseif ($poblacio == "vilabertran") $p = "Vilabertran";
    		elseif ($poblacio == "diplomatari") $p = "Diplomatari de Sant Feliu";
    		elseif ($poblacio == "rubriques") $p = "Rubriques vermelles";
    		elseif ($poblacio == "roses") $p = "Roses";

    		$entity = new Documents();
    		$entity->setPoblacio($p);
    		$nodac = $request->request->get('inputNodac');
   			$entity->setNodac($nodac);
   			$data = $request->request->get('inputData');
   			$entity->setData($data);
   			$entity->setReferencia($request->request->get('inputReferencia'));
    		$entity->setDescripcio($request->request->get('inputDescripcio'));
    		$entity->setTexte($request->request->get('inputTexte'));
    			
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $poblacio, 'info' => array($entity), 'nodac'=>$nodac, 'paraula'=>'', 'data'=>$data)
    	);
    }

    public function editarAction($seleccio,$id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Documents');
    	$info=$rep->find($id);
    	 
    	return $this->render('PrincipalBundle:AdminDocuments:editar.html.twig',
    			array('info' => $info,'seleccio' => $seleccio)
    	);
    }
    
    public function editarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
	    	$rep = $em->getRepository('ArxiuBundle:Documents');

	    	$poblacio = $request->request->get('inputSeleccio');
	    	
	    	$p='';
	    	if ($poblacio == "carlemany") $p = "Cartoral de Carlemany";
	    	elseif ($poblacio == "organya") $p = "Organya";
	    	elseif ($poblacio == "vilabertran") $p = "Vilabertran";
	    	elseif ($poblacio == "diplomatari") $p = "Diplomatari de Sant Feliu";
	    	elseif ($poblacio == "rubriques") $p = "Rubriques vermelles";
	    	elseif ($poblacio == "roses") $p = "Roses";
	    	
	    	$entity=$rep->find($request->request->get('id'));
	    	$entity->setPoblacio($p);
	    	$nodac = $request->request->get('inputNodac');
	    	$entity->setNodac($nodac);
	    	$data = $request->request->get('inputData');
	    	$entity->setData($data);
	    	$entity->setReferencia($request->request->get('inputReferencia'));
	    	$entity->setDescripcio($request->request->get('inputDescripcio'));
	    	$entity->setTexte($request->request->get('inputTexte'));
	    	 
	    	$em->persist($entity);
	    	$em->flush();
	    	$this->get('session')->getFlashBag()->add(
	    			'success',
	    			"Entrada afegida correctament!"
	    	);
	    }
	    	 
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $poblacio, 'info' => array($entity), 'nodac'=>$nodac, 'paraula'=>'', 'data'=>$data)
    	);
    }

    public function eliminarAction($seleccio,$id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Documents');
    	$info=$rep->find($id);
    	 
    	return $this->render('PrincipalBundle:AdminDocuments:eliminar.html.twig',
    			array('info' => $info,'seleccio' => $seleccio)
    	);
    }
    
    public function eliminarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$id = $request->request->get('id');
    		$poblacio = $request->request->get('inputSeleccio');
	    	$em = $this->getDoctrine()->getManager();
	    	$rep = $em->getRepository('ArxiuBundle:Documents');
	    	$entity=$rep->find($id);
    		$em->remove($entity);
    		$em->flush();
    			
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha eliminat correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $poblacio, 'info' => null, 'nodac'=>'', 'paraula'=>'', 'data'=>'')
    	);
    }
    
/*
 * Adlimina
 */    
    public function nouAdliminaAction($seleccio)
    {
    	return $this->render('PrincipalBundle:AdminDocuments:nouAdlimina.html.twig',
    			array('seleccio' => $seleccio)
    	);
    }
    
    public function nouConfirmarAdliminaAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
    
    		$poblacio = $request->request->get('inputSeleccio');
    
    		$entity = new DocumentsAdlimina();
    		$entity->setPoblacio($poblacio);
    		$nodac = $request->request->get('inputNodac');
    		$entity->setNodac($nodac);

    		$entity->setTitol($request->request->get('inputTitol'));
    		$entity->setTexte($request->request->get('inputTexte'));
    		 
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $poblacio, 'info' => array($entity), 'nodac'=>$nodac, 'paraula'=>'')
    	);
    }
    
    public function editarAdliminaAction($seleccio,$id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:DocumentsAdlimina');
    	$info=$rep->find($id);
    
    	return $this->render('PrincipalBundle:AdminDocuments:editarAdlimina.html.twig',
    			array('info' => $info,'seleccio' => $seleccio)
    	);
    }
    
    public function editarConfirmarAdliminaAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:DocumentsAdlimina');    
    		$poblacio = $request->request->get('inputSeleccio');
    
    		$entity=$rep->find($request->request->get('id'));
    		$entity->setPoblacio($poblacio);
    		$nodac = $request->request->get('inputNodac');
    		$entity->setNodac($nodac);
    		$entity->setTitol($request->request->get('inputTitol'));
    		$entity->setTexte($request->request->get('inputTexte'));
    		 
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	 
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $poblacio, 'info' => array($entity), 'nodac'=>$nodac, 'paraula'=>'')
    	);
    }
    
    public function eliminarAdliminaAction($seleccio,$id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:DocumentsAdlimina');
    	$info=$rep->find($id);
    
    	return $this->render('PrincipalBundle:AdminDocuments:eliminarAdlimina.html.twig',
    			array('info' => $info,'seleccio' => $seleccio)
    	);
    }
    
    public function eliminarConfirmarAdliminaAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$id = $request->request->get('id');
    		$poblacio = $request->request->get('inputSeleccio');
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:DocumentsAdlimina');
    		$entity=$rep->find($id);
    		$em->remove($entity);
    		$em->flush();
    		 
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha eliminat correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $poblacio, 'info' => null, 'nodac'=>'', 'paraula'=>'', 'data'=>'')
    	);
    }
    
}    