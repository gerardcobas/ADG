<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use ADG\ArxiuBundle\Entity\Documents;
use ADG\ArxiuBundle\Entity\DocumentsAdlimina;
use ADG\ArxiuBundle\Entity\IndexPersones;
use ADG\ArxiuBundle\Entity\IndexLlocs;

class AdminLlistatController extends Controller
{
    public function nouAction($tipus)
    {
    	return $this->render('PrincipalBundle:AdminLlistat:nou.html.twig',
    		array('tipus' => $tipus)
    	);
    }
    
    public function nouConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
			
    		$tipus=$request->request->get('tipus');
    		$nodac = $request->request->get('inputNodac');
    		$nom = $request->request->get('inputNom');
    		if ($tipus=="persona") {
    			$entity = new IndexPersones();
    			$rep = $em->getRepository('ArxiuBundle:IndexPersones');
    			$nouId=$rep->findNewId("Per-001-");
    			$entity->setNum($nouId);
    			$entity->setNodac($nodac);
    			$entity->setNom($nom);				
    		}
    		else{
    			$entity = new IndexLlocs();
    			$rep = $em->getRepository('ArxiuBundle:IndexLlocs');
    			$nouId=$rep->findNewId("Lloc-001-");
    			
    			$entity->setNum($nouId);
    			$entity->setNodac($nodac);
    			$entity->setNom($nom);
    		}
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
    			array('info' => array($entity),'noms'=>null,'tipus'=>$tipus, 'paraula'=>$nom, 'select'=>"detall")
    	);
    	

    }

    public function editarAction($tipus,$nom,$id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	
    	if ($tipus == 'persona') {
    		$rep = $em->getRepository('ArxiuBundle:IndexPersones');
    	}
    	elseif ($tipus == 'lloc') {
    		$rep = $em->getRepository('ArxiuBundle:IndexLlocs');
    	}
    	$info=$rep->find(array(
	    			'nom' => $nom,
	    			'num' => $id
	    	));
    	return $this->render('PrincipalBundle:AdminLlistat:editar.html.twig',
    			array('info' => $info,'tipus' => $tipus)
    	);
    }
    
    public function editarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();

	    	$tipus = $request->request->get('tipus');
	    	$rep = $em->getRepository('ArxiuBundle:IndexPersones');
	    	
	    	if ($tipus == 'persona') {
	    		$rep = $em->getRepository('ArxiuBundle:IndexPersones');
	    	}
	    	elseif ($tipus=='lloc') {
	    		$rep = $em->getRepository('ArxiuBundle:IndexLlocs');
	    	}
			else{
				return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
						array('info'=>null,'noms'=>NULL,'tipus'=>'persona', 'paraula'=>'', 'select'=>"llista")
				);
			}
	    	$entity=$rep->find(array(
	    			'nom' => $request->request->get('nom'),
	    			'num' => $request->request->get('num')
	    	));
	    	
	    	
	    	$nodac = $request->request->get('inputNodac');
	    	$entity->setNodac($nodac);
	    	$nom = $request->request->get('inputNom');
	    	$entity->setNom($nom);
	    	
	    	$em->persist($entity);
	    	$em->flush();
	    	$this->get('session')->getFlashBag()->add(
	    			'success',
	    			"Entrada afegida correctament!"
	    	);
	    }
	    	 
    	return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
    			array('info' => array($entity),'noms'=>null,'tipus'=>$tipus, 'paraula'=>$nom, 'select'=>"detall")
    	);
    }

    public function eliminarAction($tipus,$nom,$id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
		if ($tipus == 'persona') {
    		$rep = $em->getRepository('ArxiuBundle:IndexPersones');
    	}
    	elseif ($tipus == 'lloc') {
    		$rep = $em->getRepository('ArxiuBundle:IndexLlocs');
    	}
    	$info=$rep->find(array(
	    			'nom' => $nom,
	    			'num' => $id
	    	));
    	return $this->render('PrincipalBundle:AdminLlistat:eliminar.html.twig',
    			array('info' => $info,'tipus' => $tipus)
    	);
    	
    }
    
    public function eliminarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$num = $request->request->get('num');
    		$nom = $request->request->get('nom');
    		$tipus = $request->request->get('tipus');
    		
    		$em = $this->getDoctrine()->getManager();
    		if ($tipus == 'persona') {
	    		$rep = $em->getRepository('ArxiuBundle:IndexPersones');
	    	}
	    	elseif ($tipus=='lloc') {
	    		$rep = $em->getRepository('ArxiuBundle:IndexLlocs');
	    	}
			else{
				return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
						array('info'=>null,'noms'=>NULL,'tipus'=>'persona', 'paraula'=>'', 'select'=>"llista")
				);
			}
	    	$entity=$rep->find(array(
	    			'nom' => $nom,
	    			'num' => $num
	    	));
	    	
    		$em->remove($entity);
    		$em->flush();
    			
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha eliminat correctament!"
    		);
    	}
        return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
    		array('info'=>null,'noms'=>NULL,'tipus'=>'persona', 'paraula'=>'', 'select'=>"llista")	
        );
    }
    
    
}    