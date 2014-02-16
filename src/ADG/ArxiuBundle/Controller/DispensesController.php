<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DispensesController extends Controller
{
    public function dispensesAction()
    {
        return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    		array('seleccio'=>'dispenses', 'info'=>null,'maNom'=>'', 'maCog'=>'','maCog2'=>'','maNaix'=>'','maRes'=>'',
    			'muNom'=>'', 'muCog'=>'','muCog2'=>'','muNaix'=>'','muRes'=>'',
    			'any'=>'', 'interval1'=>'', 'interval2'=>'','param'=>'', 'tipus'=>'relaxada')	
        );
    }
    
    public function cognomsAction()
    {
    	return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    			array('seleccio'=>'cognoms', 'info'=>null, 'cognom'=>'','paraula'=>'','grau'=>'mitjana')
    	);
    }

    public function cercaDispensesAction()
    {
    	$request = $this->getRequest();
    	$info=null;
    	
    	if ($request->isMethod('POST')) {
    				$cercaTipus=$request->request->get('cercaTipus');
    		
    				$maNom=$request->request->get('maNom');
    				$maCog=$request->request->get('maCog');
    				$maCog2=$request->request->get('maCog2');
    				$maNaix=$request->request->get('maNaix');
    				$maRes=$request->request->get('maRes');
    				
    				$muNom=$request->request->get('muNom');
    				$muCog=$request->request->get('muCog');
    				$muCog2=$request->request->get('muCog2');
    				$muNaix=$request->request->get('muNaix');
    				$muRes=$request->request->get('muRes');
    				
    				$any=$request->request->get('any');
    				$interval1=$request->request->get('interval1');
    				$interval2=$request->request->get('interval2');
    				$param=$request->request->get('param');
    				
    		
    				$em = $this->getDoctrine()->getManager();
    				$rep = $em->getRepository('ArxiuBundle:Dispenses');
    				
    				if ($cercaTipus=="relaxada") {
    					$info=$rep->findTot(
    							$maNom, $maCog, $maCog2, $maNaix, $maRes,
    							$muNom, $muCog, $muCog2, $muNaix, $muRes,
    							$any, $interval1, $interval2, $param
    					);
    					$tipus='relaxada';
    				}
    				else{
    					$info=$rep->findTotEstricta(
    							$maNom, $maCog, $maCog2, $maNaix, $maRes,
    							$muNom, $muCog, $muCog2, $muNaix, $muRes,
    							$any, $interval1, $interval2, $param
    					);
    					$tipus='estricta';
    				}
    	}
    	
    	
    	return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    			array('seleccio'=>'dispenses', 'info'=>$info,'maNom'=>$maNom, 'maCog'=>$maCog,'maCog2'=>$maCog2,'maNaix'=>$maNaix,'maRes'=>$maRes,
    			'muNom'=>$muNom, 'muCog'=>$muCog,'muCog2'=>$muCog2,'muNaix'=>$muNaix,'muRes'=>$muRes,
    			'any'=>$any, 'interval1'=>$interval1, 'interval2'=>$interval2, 'param'=>$param, 'tipus'=>$tipus)
    	);
    }
    
    public function cercaCognomsAction()
    {
    	$request = $this->getRequest();
    	$info=null;
    	 
    	if ($request->isMethod('POST')) {
    		$cognom=$request->request->get('cognom');
    		$grau=$request->request->get('param');
    		$paraula=$request->request->get('paraula');
    		
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:Dispenses');
    		$info=$rep->findTotCognom($paraula, $cognom, $grau);
    	}
    	
    	return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    			array('seleccio'=>'cognoms', 'info'=>$info, 'cognom'=>$cognom,'paraula'=>$paraula, 'grau'=>$grau)
    	);
    }
    
    public function detallAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Dispenses');
    	$info=$rep->find($id);
    	
    	//TODO calcular link pdf y retornarlo
    	$document=self::obtePath($id);

    	return $this->render('ArxiuBundle:Dispenses:detall.html.twig',
    			array('info' => $info, 'document' => $document)
    	);

    }
    
    
    /**
     * Calcula el path del document
     */
    private function obtePath($id){
    	$resultat=array();
    	
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:Dispenses');
    	list($any, $document)=$rep->findForDocument($id);

    	/*
    	 * TODO ALGORITME
    	 *  
		 * problema: al migrar bd cal invertir atribut control amb numref, ja que numref esta buit a vegades
		 * 
		 *	si bd te atribut document ple, fer servir akest path
		 *	sino:
		 *		si control(el nou) buit llavors es dispensa d'impediment
		 *		sino dispensa proclama
		 *
    	 */
    	
    	
    	$resultat[]="ftp://192.168.1.39/test/test.pdf";
    	$resultat[]="ftp://192.168.1.39/test/test.pdf";
    	return $resultat;
    }
    
}
