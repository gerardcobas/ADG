<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocumentsController extends Controller
{
    public function documentsAction()
    {
        return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => null, 'info' => null)
        );
    }
    
    public function selectAction($seleccio)
    {
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $seleccio, 'info' => $info, 'nodac'=>'', 'paraula'=>'', 'data'=>'')
    	);
    }

    public function cercarAction($seleccio)
    {	
    	
    	if ($seleccio == "carlemany" or $seleccio == "organya" or $seleccio == "vilabertran" or $seleccio == "diplomatari" or $seleccio == "rubriques" or $seleccio == "roses")
    	{
    		$request = $this->getRequest();
    		if ($request->isMethod('POST')) {
    			$paraula = $request->request->get('paraula');
    			$nodac = $request->request->get('nodac');
    			$data = $request->request->get('data');
    		}
    		$info=null;
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:Documents');
    		$info=$rep->findDocuments($seleccio, $paraula, $nodac, $data);
    	}
    	
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio' => $seleccio, 'info' => $info, 'nodac'=>$nodac, 'paraula'=>$paraula, 'data'=>$data)
    	);
    }
    
    public function cercarAdliminaAction($seleccio)
    {
    	if ($seleccio == "ager" or $seleccio == "barcelona" or $seleccio == "girona" or $seleccio == "lleida" or $seleccio == "solsona" or $seleccio == "tarragona"
    			or $seleccio == "tortosa" or $seleccio == "urgell" or $seleccio == "vic")
    	{
    		$request = $this->getRequest();
    		if ($request->isMethod('POST')) {
    			$paraula = $request->request->get('paraula');
    			$nodac = $request->request->get('nodac');
    		}
    		$info=null;
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:DocumentsAdlimina');
    		$info=$rep->findAdlimina($seleccio, $paraula, $nodac);
    	}
    	
    	return $this->render('ArxiuBundle:Documents:documents.html.twig',
    			array('seleccio'=>$seleccio, 'info'=>$info, 'nodac'=>$nodac, 'paraula'=>$paraula)
    	);
    }
    
    public function detallAction($id)
    {
    	
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Documents');
    	$info=$rep->find($id);
    	
    	return $this->render('ArxiuBundle:Documents:detall.html.twig',
    			array('info' => $info)
    	);
    }
    
    
    
    
}
