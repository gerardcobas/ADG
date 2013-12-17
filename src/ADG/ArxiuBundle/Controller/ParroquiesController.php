<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParroquiesController extends Controller
{
    public function parroquiesAction()
    {
        return $this->render('ArxiuBundle:Parroquies:parroquies.html.twig',
    		array('seleccio'=>'parroquies','info'=>null,'nom'=>'')	
        );
    }
    
    public function cercaParroquiesAction()
    {
    	$request = $this->getRequest();
    	$info=null;
    	if ($request->isMethod('POST')) {
    		$nom=$request->request->get('nom');
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:Parroquies');
    		$info=$rep->findParroquies($nom);
    	}
        return $this->render('ArxiuBundle:Parroquies:parroquies.html.twig',
    		array('seleccio'=>'parroquies','info'=>$info,'nom'=>$nom)	
        );
    }
    
    public function detallAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Parroquies');
    	$info=$rep->find($id);
    	
    	$nom=$rep->findNom($id);
    	
    	$rep = $em->getRepository('ArxiuBundle:ParroquiesArxius');
    	$arxius=$rep->findInfo($nom);
    
    	return $this->render('ArxiuBundle:Parroquies:detall.html.twig',
    			array('info'=>$info, 'arxius'=>$arxius)
    	);
    }
    
    public function parroquiesArxiusAction()
    {
    	return $this->render('ArxiuBundle:Parroquies:parroquiesArxius.html.twig',
    			array('seleccio'=>'arxius','info'=>null,'nodac'=>'', 'data'=>'', 'nom'=>'', 'paraula'=>'')
    	);
    }

    public function cercaParroquiesArxiusAction()
    {
    	$request = $this->getRequest();
    	$info=null;
    	
    	if ($request->isMethod('POST')) {
    		$nodac=$request->request->get('nodac');
    		$data=$request->request->get('data');
    		$nom=$request->request->get('nom');
    		$paraula=$request->request->get('paraula');
    		
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:ParroquiesArxius');

    		$info=$rep->findParroquies($nodac, $data, $nom, $paraula);
    	}
    	
    	
        return $this->render('ArxiuBundle:Parroquies:parroquiesArxius.html.twig',
    		array('seleccio'=>'arxius','info'=>$info, 'nodac'=>$nodac, 'data'=>$data, 'nom'=>$nom, 'paraula'=>$paraula)	
        );
    }
    
    
    public function detallArxiusAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:ParroquiesArxius');
    	$info=$rep->find($id);
    	 
    	return $this->render('ArxiuBundle:Parroquies:detallArxius.html.twig',
    			array('info'=>$info)
    	);
    }
  
}
