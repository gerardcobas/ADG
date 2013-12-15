<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParroquiesController extends Controller
{
    public function parroquiesAction()
    {
        return $this->render('ArxiuBundle:Parroquies:parroquies.html.twig',
    		array('info'=>null,'nodac'=>'', 'data'=>'', 'nom'=>'', 'paraula'=>'')	
        );
    }

    public function cercaParroquiesAction()
    {
    	$request = $this->getRequest();
    	$info=null;
    	
    	if ($request->isMethod('POST')) {
    		$nodac=$request->request->get('nodac');
    		$data=$request->request->get('data');
    		$nom=$request->request->get('nom');
    		$paraula=$request->request->get('paraula');
    		
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:Parroquies');

    		$info=$rep->findParroquies($nodac, $data, $nom, $paraula);
    	}
    	
    	
        return $this->render('ArxiuBundle:Parroquies:parroquies.html.twig',
    		array('info'=>$info, 'nodac'=>$nodac, 'data'=>$data, 'nom'=>$nom, 'paraula'=>$paraula)	
        );
    }
    
    
    public function detallAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Parroquies');
    	$info=$rep->find($id);
    	 
    	return $this->render('ArxiuBundle:Parroquies:detall.html.twig',
    			array('info'=>$info)
    	);
    }
  
}
