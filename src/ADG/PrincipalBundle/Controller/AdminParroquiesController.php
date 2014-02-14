<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use ADG\ArxiuBundle\Entity\Fons;
use ADG\ArxiuBundle\Entity\FonsArxius;
use ADG\ArxiuBundle\Entity\FonsCapellans;
use ADG\ArxiuBundle\Entity\FonsMitra;
use ADG\ArxiuBundle\Entity\FonsLiberden;
use ADG\ArxiuBundle\Entity\FonsMonges;
use ADG\ArxiuBundle\Entity\FonsSeminaristes;
use ADG\ArxiuBundle\Entity\FonsTestaments;
use ADG\ArxiuBundle\Entity\Parroquies;
use ADG\ArxiuBundle\Entity\ParroquiesArxius;


class AdminParroquiesController extends Controller
{
    public function nouAction()
    {
    	return $this->render('PrincipalBundle:AdminParroquies:nou.html.twig');
    }
    
    public function nouConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = new Parroquies();
	    	$nom = $request->request->get('inputNom');
    		$entity->setNom($nom);
    		$entity->setNum($request->request->get('inputNum'));
    		$entity->setDescripcio($request->request->get('inputDescripcio'));
    		$entity->setBibliografia($request->request->get('inputBibliografia'));
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Parroquies:parroquies.html.twig',
    			array('seleccio'=>'parroquies','info' => array($entity),'nom'=>$nom)
    	);
    }

    public function editarAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Parroquies');
    	$info=$rep->find($id);
    	 
    	return $this->render('PrincipalBundle:AdminParroquies:editar.html.twig',
    			array('info' => $info)
    	);
    }
    
    public function editarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
	    	$rep = $em->getRepository('ArxiuBundle:Parroquies');
	    	$entity=$rep->find($request->request->get('id'));
	    	
	    	$nom = $request->request->get('inputNom');
    		$entity->setNom($nom);
    		$entity->setNum($request->request->get('inputNum'));
    		$entity->setDescripcio($request->request->get('inputDescripcio'));
    		$entity->setBibliografia($request->request->get('inputBibliografia'));
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Parroquies:parroquies.html.twig',
    			array('seleccio'=>'parroquies','info' => array($entity),'nom'=>$nom)
    	);
    }

    public function eliminarAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Parroquies');
    	$info=$rep->find($id);
    	 
    	return $this->render('PrincipalBundle:AdminParroquies:eliminar.html.twig',
    			array('info' => $info)
    	);
    }
    
    public function eliminarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$id = $request->request->get('id');
	    	$em = $this->getDoctrine()->getManager();
	    	$rep = $em->getRepository('ArxiuBundle:Parroquies');
	    	$entity=$rep->find($id);
    		$em->remove($entity);
    		$em->flush();
    			
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha eliminat correctament!"
    		);
    	}
    	return $this->redirect($this->generateUrl('parroquies'));
    }
    
/*
 * Arxiu dipositats
 */    

    public function nouArxiusAction()
    {
    	return $this->render('PrincipalBundle:AdminParroquies:nouArxius.html.twig');
    }
    
    public function nouConfirmarArxiusAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = new ParroquiesArxius();
    		
    		$nodac = $request->request->get('inputNodac');
    		$entity->setNodac($nodac);
    		$nom = $request->request->get('inputNom');
    		$entity->setNom($nom);
    		$data = $request->request->get('inputData');
    		$entity->setData($data);
    		
    		$entity->setTitol($request->request->get('inputTitol'));
    		$entity->setUnitat($request->request->get('inputUnitat'));
    		$entity->setVolum($request->request->get('inputVolum'));
    		$entity->setMides($request->request->get('inputMides'));
    		$entity->setCobertes($request->request->get('inputCobertes'));
    		$entity->setPagines($request->request->get('inputPagines'));
    		$entity->setAmbIndex($request->request->get('inputAmbIndex'));
    		$entity->setAcces($request->request->get('inputAcces'));
    		$entity->setNotes($request->request->get('inputNotes'));
    		$entity->setEstat($request->request->get('inputEstat'));
    		$entity->setLlengua($request->request->get('inputLlengua'));
    		$entity->setAutors($request->request->get('inputAutors'));
    		$entity->setFitxa($request->request->get('inputFitxa'));
    		$entity->setDataIngres($request->request->get('inputDataIngres'));
    		
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Parroquies:parroquiesArxius.html.twig',
    			array('seleccio'=>'arxius','info' => array($entity),'nodac'=>$nodac, 'data'=>$data, 'nom'=>$nom, 'paraula'=>'')
    	);
    }
    
    public function editarArxiusAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:ParroquiesArxius');
    	$info=$rep->find($id);
    
    	return $this->render('PrincipalBundle:AdminParroquies:editarArxius.html.twig',
    			array('info' => $info)
    	);
    }
    
    public function editarConfirmarArxiusAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:ParroquiesArxius');
    		
    		$entity=$rep->find($request->request->get('id'));

    		$nodac = $request->request->get('inputNodac');
    		$entity->setNodac($nodac);
    		$nom = $request->request->get('inputNom');
    		$entity->setNom($nom);
    		$data = $request->request->get('inputData');
    		$entity->setData($data);
    		
    		$entity->setTitol($request->request->get('inputTitol'));
    		$entity->setUnitat($request->request->get('inputUnitat'));
    		$entity->setVolum($request->request->get('inputVolum'));
    		$entity->setMides($request->request->get('inputMides'));
    		$entity->setCobertes($request->request->get('inputCobertes'));
    		$entity->setPagines($request->request->get('inputPagines'));
    		$entity->setAmbIndex($request->request->get('inputAmbIndex'));
    		$entity->setAcces($request->request->get('inputAcces'));
    		$entity->setNotes($request->request->get('inputNotes'));
    		$entity->setEstat($request->request->get('inputEstat'));
    		$entity->setLlengua($request->request->get('inputLlengua'));
    		$entity->setAutors($request->request->get('inputAutors'));
    		$entity->setFitxa($request->request->get('inputFitxa'));
    		$entity->setDataIngres($request->request->get('inputDataIngres'));
    		
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Parroquies:parroquiesArxius.html.twig',
    			array('seleccio'=>'arxius','info' => array($entity),'nodac'=>$nodac, 'data'=>$data, 'nom'=>$nom, 'paraula'=>'')
    	);
    }
    
    public function eliminarArxiusAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:ParroquiesArxius');
    	$info=$rep->find($id);
    
    	return $this->render('PrincipalBundle:AdminParroquies:eliminarArxius.html.twig',
    			array('info' => $info)
    	);
    }
    
    public function eliminarConfirmarArxiusAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$id = $request->request->get('id');
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:ParroquiesArxius');
    		$entity=$rep->find($id);
    		$em->remove($entity);
    		$em->flush();
    		 
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha eliminat correctament!"
    		);
    	}
    	return $this->redirect($this->generateUrl('parroquies_arxius'));
    }
    
}
