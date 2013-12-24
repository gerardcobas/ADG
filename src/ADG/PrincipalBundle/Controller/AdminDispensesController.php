<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use ADG\ArxiuBundle\Entity\Dispenses;


class AdminDispensesController extends Controller
{
    public function nouAction()
    {
    	return $this->render('PrincipalBundle:AdminDispenses:nou.html.twig');
    }
    
    public function nouConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = new Dispenses();
    		
    		//atributs generals
    		$nodac=$request->request->get('inputNodac');
    		$entity->setNodac($nodac);
    		
    		$entity->setData($request->request->get('inputData'));
    		
    		$any=$request->request->get('inputAny');
    		$entity->setAny($any);
    		
    		$entity->setTipus($request->request->get('inputTipus'));
    		$entity->setControl($request->request->get('inputControl'));
    		$entity->setDocument($request->request->get('inputDocument'));
    		
    		//atributs marit
    		$cog1Marit=$request->request->get('inputCog1Marit');
    		$entity->setMaritCognom1($cog1Marit);
    		
    		$cog2Marit=$request->request->get('inputCog2Marit');
    		$entity->setMaritCognom2($cog2Marit);
    		
    		$nomMarit=$request->request->get('inputNomMarit');
    		$entity->setMaritNom($nomMarit);
    		
    		$entity->setMaritEstatCivil($request->request->get('inputEstatMarit'));
    		$entity->setMaritOfici($request->request->get('inputOficiMarit'));
    		
    		$nacionalitatMarit=$request->request->get('inputNacionalitatMarit');
    		$entity->setMaritNacionalitat($nacionalitatMarit);
    		
    		$llocNaixMarit=$request->request->get('inputLlocNaixMarit');
    		$entity->setMaritLlocNaixement($llocNaixMarit);
    		
    		$veinatgeMarit=$request->request->get('inputVeinatgeMarit');
    		$entity->setMaritVeinatge($veinatgeMarit);
    		
    		//atributs muller
    		$cog1Muller=$request->request->get('inputCog1Muller');
    		$entity->setMullerCognom1($cog1Muller);
    		
    		$cog2Muller=$request->request->get('inputCog2Muller');
    		$entity->setMullerCognom2($cog2Muller);
    		
    		$nomMuller=$request->request->get('inputNomMuller');
    		$entity->setMullerNom($nomMuller);
    		
    		$entity->setMullerEstatCivil($request->request->get('inputEstatMuller'));
    		$entity->setMullerOfici($request->request->get('inputOficiMuller'));
    		
    		$nacionalitatMuller=$request->request->get('inputNacionalitatMuller');
    		$entity->setMullerNacionalitat($nacionalitatMuller);
    		
    		$llocNaixMuller=$request->request->get('inputLlocNaixMuller');
    		$entity->setMullerLlocNaixement($llocNaixMuller);
    		
    		$veinatgeMuller=$request->request->get('inputVeinatgeMuller');
    		$entity->setMullerVeinatge($veinatgeMuller);
    		
    		
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    			array('seleccio'=>'dispenses', 'info'=>array($entity),
    					'maNom'=>$nomMarit, 'maCog'=>$cog1Marit,'maCog2'=>$cog2Marit,'maNaix'=>$llocNaixMarit,'maRes'=>$veinatgeMarit,
    					'muNom'=>$nomMuller, 'muCog'=>$cog1Muller,'muCog2'=>$cog2Muller,'muNaix'=>$llocNaixMuller,'muRes'=>$veinatgeMuller,
    					'any'=>$any, 'interval1'=>'', 'interval2'=>'','param'=>'', 'tipus'=>'relaxada')
    	);
    }
    
    public function editarAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();

    	$rep = $em->getRepository('ArxiuBundle:Dispenses');
    	$info=$rep->find($id);
    
    	return $this->render('PrincipalBundle:AdminDispenses:editar.html.twig',
    			array('info' => $info)
    	);
    }
    
    public function editarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:Dispenses');

    		$entity=$rep->find($request->request->get('numref'));
    
			//atributs generals
    		$nodac=$request->request->get('inputNodac');
    		$entity->setNodac($nodac);
    		
    		$entity->setData($request->request->get('inputData'));
    		
    		$any=$request->request->get('inputAny');
    		$entity->setAny($any);
    		
    		$entity->setTipus($request->request->get('inputTipus'));
    		$entity->setControl($request->request->get('inputControl'));
    		$entity->setDocument($request->request->get('inputDocument'));
    		
    		//atributs marit
    		$cog1Marit=$request->request->get('inputCog1Marit');
    		$entity->setMaritCognom1($cog1Marit);
    		
    		$cog2Marit=$request->request->get('inputCog2Marit');
    		$entity->setMaritCognom2($cog2Marit);
    		
    		$nomMarit=$request->request->get('inputNomMarit');
    		$entity->setMaritNom($nomMarit);
    		
    		$entity->setMaritEstatCivil($request->request->get('inputEstatMarit'));
    		$entity->setMaritOfici($request->request->get('inputOficiMarit'));
    		
    		$nacionalitatMarit=$request->request->get('inputNacionalitatMarit');
    		$entity->setMaritNacionalitat($nacionalitatMarit);
    		
    		$llocNaixMarit=$request->request->get('inputLlocNaixMarit');
    		$entity->setMaritLlocNaixement($llocNaixMarit);
    		
    		$veinatgeMarit=$request->request->get('inputVeinatgeMarit');
    		$entity->setMaritVeinatge($veinatgeMarit);
    		
    		//atributs muller
    		$cog1Muller=$request->request->get('inputCog1Muller');
    		$entity->setMullerCognom1($cog1Muller);
    		
    		$cog2Muller=$request->request->get('inputCog2Muller');
    		$entity->setMullerCognom2($cog2Muller);
    		
    		$nomMuller=$request->request->get('inputNomMuller');
    		$entity->setMullerNom($nomMuller);
    		
    		$entity->setMullerEstatCivil($request->request->get('inputEstatMuller'));
    		$entity->setMullerOfici($request->request->get('inputOficiMuller'));
    		
    		$nacionalitatMuller=$request->request->get('inputNacionalitatMuller');
    		$entity->setMullerNacionalitat($nacionalitatMuller);
    		
    		$llocNaixMuller=$request->request->get('inputLlocNaixMuller');
    		$entity->setMullerLlocNaixement($llocNaixMuller);
    		
    		$veinatgeMuller=$request->request->get('inputVeinatgeMuller');
    		$entity->setMullerVeinatge($veinatgeMuller);
    
    		$em->persist($entity);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"Entrada afegida correctament!"
    		);
    	}
    	 
    	return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    			array('seleccio'=>'dispenses', 'info'=>array($entity),
    					'maNom'=>$nomMarit, 'maCog'=>$cog1Marit,'maCog2'=>$cog2Marit,'maNaix'=>$llocNaixMarit,'maRes'=>$veinatgeMarit,
    					'muNom'=>$nomMuller, 'muCog'=>$cog1Muller,'muCog2'=>$cog2Muller,'muNaix'=>$llocNaixMuller,'muRes'=>$veinatgeMuller,
    					'any'=>$any, 'interval1'=>'', 'interval2'=>'','param'=>'', 'tipus'=>'relaxada')
    	);
    }
    
    
    public function eliminarAction($id)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    
    	$rep = $em->getRepository('ArxiuBundle:Dispenses');
    	$info=$rep->find($id);
    
    	return $this->render('PrincipalBundle:AdminDispenses:eliminar.html.twig',
    			array('info' => $info)
    	);
    }
    
    public function eliminarConfirmarAction()
    {
    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$num = $request->request->get('numref');
    
    		$em = $this->getDoctrine()->getManager();
    		$rep = $em->getRepository('ArxiuBundle:Dispenses');
    	
    		$entity=$rep->find($num);
    		$em->remove($entity);
    		$em->flush();
    		 
    		$this->get('session')->getFlashBag()->add(
    				'success',
    				"S'ha eliminat correctament!"
    		);
    	}
        return $this->render('ArxiuBundle:Dispenses:dispenses.html.twig',
    		array('seleccio'=>'dispenses', 'info'=>null,'maNom'=>'', 'maCog'=>'','maCog2'=>'','maNaix'=>'','maRes'=>'',
    			'muNom'=>'', 'muCog'=>'','muCog2'=>'','muNaix'=>'','muRes'=>'',
    			'any'=>'', 'interval1'=>'', 'interval2'=>'','param'=>'', 'tipus'=>'relaxada')	
        );
    }
    
}
