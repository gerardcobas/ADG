<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Adg\ArxiuBundle\Entity\GuiaFons;

class AdminGuiaController extends Controller
{
	/**
	 * Obre formulari per afegir un nou element del nivell de l'indicat i amb els parametres definits.
	 */
	public function nouAction($id)
	{
		list($info,$tam)=self::buscaInfo($id);
		return $this->render('PrincipalBundle:AdminGuia:nou.html.twig',
				array('info' => $info, 'tam'=> $tam)
		);
	}
	
	public function nouConfirmarAction()
	{
		$request = $this->getRequest();
    	if ($request->isMethod('POST')) {

    		$part1 = $request->request->get('nivell');
    		$part2=$request->request->get('suffix');
    		$nivell=$part1.$part2;
    		$b=self::comprovaExistencia($nivell);
    		
    		if ($b===true) {
    			
    			$this->get('session')->getFlashBag()->add(
    					'error',
    					"Ja existeix!"
    			);
    			return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
    		}
    		else{
    			
    			$this->get('session')->getFlashBag()->add(
    					'success',
    					"Afegit correctament!"
    			);
    			return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
    		}

    		
    	}
    	return $this->redirect($this->generateUrl('guia'));
	}
	
	public function subnivellAction($id)
	{
		/*comprovara si ja existeix aquesta entrada!*/
		return $this->render('PrincipalBundle:AdminGuia:subnivell.html.twig');
	}
	
	public function editarAction($id)
	{
		return $this->render('PrincipalBundle:AdminGuia:editar.html.twig');
	}
	
	public function eliminarAction($id)
	{
		return $this->render('PrincipalBundle:AdminGuia:eliminar.html.twig');
	}
	
	private function buscaInfo($id){

		$em = $this->getDoctrine()->getManager();
		//es divideix l'identificador indicat per saber a quin nivell es troba
		$parts = explode('.', $id);
		$tam=sizeof($parts);
		$info=null;
	
		//obtenir la informacio del identificador indicat
		if($tam==2){
			$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
			$info=$repFons->find($id);
		}
		else if($tam==3){
			$repSub = $em->getRepository('ArxiuBundle:GuiaSubfons');
			$info=$repSub->find($id);
		}
		else if($tam==4){
			$repGrup = $em->getRepository('ArxiuBundle:GuiaGrup');
			$info=$repGrup->find($id);
		}
		else if($tam==5){
			$repSerie = $em->getRepository('ArxiuBundle:GuiaSerie');
			$info=$repSerie->find($id);
		}
		else if($tam==6){
			$repUcomp = $em->getRepository('ArxiuBundle:GuiaUcomposta');
			$info=$repUcomp->find($id);
		}
		else if($tam==7){
			$repUsim = $em->getRepository('ArxiuBundle:GuiaUsimple');
			$info=$repUsim->find($id);
		}
		else if($tam==8){
			$repUinst = $em->getRepository('ArxiuBundle:GuiaUinstalacio');
			$info=$repUinst->find($id);
		}
	
		return array($info,$tam);
	}
	
	private function comprovaExistencia($id){
	
		$em = $this->getDoctrine()->getManager();
		//es divideix l'identificador indicat per saber a quin nivell es troba
		$parts = explode('.', $id);
		$tam=sizeof($parts);
		$info=null;
	
		//obtenir la informacio del identificador indicat
		if($tam==2){
			$repFons = $em->getRepository('ArxiuBundle:GuiaFons');
			$info=$repFons->findOneByNivell($id);
		}
		else if($tam==3){
			$repSub = $em->getRepository('ArxiuBundle:GuiaSubfons');
			$info=$repSub->findOneByNivell($id);
		}
		else if($tam==4){
			$repGrup = $em->getRepository('ArxiuBundle:GuiaGrup');
			$info=$repGrup->findOneByNivell($id);
		}
		else if($tam==5){
			$repSerie = $em->getRepository('ArxiuBundle:GuiaSerie');
			$info=$repSerie->findOneByNivell($id);
		}
		else if($tam==6){
			$repUcomp = $em->getRepository('ArxiuBundle:GuiaUcomposta');
			$info=$repUcomp->findOneByNivell($id);
		}
		else if($tam==7){
			$repUsim = $em->getRepository('ArxiuBundle:GuiaUsimple');
			$info=$repUsim->findOneByNivell($id);
		}
		else if($tam==8){
			$repUinst = $em->getRepository('ArxiuBundle:GuiaUinstalacio');
			$info=$repUinst->findOneByNivell($id);
		}
		
		if($info === null){
			return false;
		}
		else{
			return true;
		}
	
		return false;
	}
		
}