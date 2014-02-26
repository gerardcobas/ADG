<?php

namespace ADG\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use ADG\ArxiuBundle\Entity\GuiaFons;
use ADG\ArxiuBundle\Entity\GuiaSubfons;
use ADG\ArxiuBundle\Entity\GuiaGrup;
use ADG\ArxiuBundle\Entity\GuiaSerie;
use ADG\ArxiuBundle\Entity\GuiaUcomposta;
use ADG\ArxiuBundle\Entity\GuiaUsimple;
use ADG\ArxiuBundle\Entity\GuiaUinstalacio;

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
	
	/**
	 * Crea la nova entrada a partir de l'informacio del formulari.
	 * Comprovarà si existeix en primer lloc.
	 */
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
    					"Error! Ja existeix aquest nivell!"
    			);
    			return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
    		}
    		else{
    			$em = $this->getDoctrine()->getManager();

    			$entity= self::creaEntitat($nivell);
    			
    			$entity->setNivell($nivell);
    			$entity->setTitol($request->request->get('titol'));
    			$entity->setCodi($request->request->get('codi'));
    			$entity->setData($request->request->get('data'));
    			$entity->setVolum($request->request->get('volum'));
    			
    			$entity->setNomProductor($request->request->get('nomProductor'));
    			$entity->setHistoriaProductor($request->request->get('historiaProductor'));
    			$entity->setHistoriaArxivistica($request->request->get('historiaArxivistica'));
    			$entity->setDadesIngres($request->request->get('dadesIngres'));
    			
    			$entity->setAbast($request->request->get('abast'));
    			$entity->setOrganitzacio($request->request->get('organitzacio'));
    			$entity->setInformacioUtilitzacio($request->request->get('informacioUtilitzacio'));
    			$entity->setIncrements($request->request->get('increments'));
    			
    			$entity->setCondicionsAcces($request->request->get('condicionsAcces'));
    			$entity->setCondicionsReproduccio($request->request->get('condicionsReproduccio'));
    			$entity->setLlengues($request->request->get('llengues'));
    			$entity->setCaracteristiques($request->request->get('caracteristiques'));
    			$entity->setInstruments($request->request->get('intruments'));
    			
    			$entity->setExistenciaOriginals($request->request->get('existenciaOriginals'));
    			$entity->setExistenciaReproduccions($request->request->get('existenciaReproduccio'));
    			$entity->setDocumentacio($request->request->get('documentacio'));
    			$entity->setBibliografia($request->request->get('bibliografia'));
    			
    			$entity->setNotes($request->request->get('notes'));
    			
    			$entity->setAutoria($request->request->get('autoria'));
    			$entity->setFonts($request->request->get('fonts'));
    			$entity->setRegles($request->request->get('regles'));
    			
    			$em = $this->getDoctrine()->getManager();
    			$em->persist($entity);
    			$em->flush();
    			
    			$this->get('session')->getFlashBag()->add(
    					'success',
    					"Entrada afegida correctament!"
    			);
    			return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
    		}

    		
    	}
    	return $this->redirect($this->generateUrl('guia'));
	}
	
	/**
	 * Obre formulari per afegir un subnivell a partir del nivell de l'indicat i amb els parametres d'aquest.
	 */
	public function subnivellAction($id)
	{
		list($info,$tam)=self::buscaInfo($id);
		return $this->render('PrincipalBundle:AdminGuia:subnivell.html.twig',
				array('info' => $info, 'tam'=> $tam)
		);
	}
	
	/**
	 * Crea un nou subnivell a partir de l'informacio del formulari.
	 * Comprovarà si existeix en primer lloc.
	 */
	public function subnivellConfirmarAction()
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
						"Error! Ja existeix aquest nivell!"
				);
				return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
			}
			else{
				$em = $this->getDoctrine()->getManager();
		
				$entity= self::creaEntitat($nivell);
				 
				$entity->setNivell($nivell);
				$entity->setTitol($request->request->get('titol'));
				$entity->setCodi($request->request->get('codi'));
				$entity->setData($request->request->get('data'));
				$entity->setVolum($request->request->get('volum'));
				 
				$entity->setNomProductor($request->request->get('nomProductor'));
				$entity->setHistoriaProductor($request->request->get('historiaProductor'));
				$entity->setHistoriaArxivistica($request->request->get('historiaArxivistica'));
				$entity->setDadesIngres($request->request->get('dadesIngres'));
				 
				$entity->setAbast($request->request->get('abast'));
				$entity->setOrganitzacio($request->request->get('organitzacio'));
				$entity->setInformacioUtilitzacio($request->request->get('informacioUtilitzacio'));
				$entity->setIncrements($request->request->get('increments'));
				 
				$entity->setCondicionsAcces($request->request->get('condicionsAcces'));
				$entity->setCondicionsReproduccio($request->request->get('condicionsReproduccio'));
				$entity->setLlengues($request->request->get('llengues'));
				$entity->setCaracteristiques($request->request->get('caracteristiques'));
				$entity->setInstruments($request->request->get('intruments'));
				 
				$entity->setExistenciaOriginals($request->request->get('existenciaOriginals'));
				$entity->setExistenciaReproduccions($request->request->get('existenciaReproduccio'));
				$entity->setDocumentacio($request->request->get('documentacio'));
				$entity->setBibliografia($request->request->get('bibliografia'));
				 
				$entity->setNotes($request->request->get('notes'));
				 
				$entity->setAutoria($request->request->get('autoria'));
				$entity->setFonts($request->request->get('fonts'));
				$entity->setRegles($request->request->get('regles'));
				 
				$em = $this->getDoctrine()->getManager();
				$em->persist($entity);
				$em->flush();
				 
				$this->get('session')->getFlashBag()->add(
						'success',
						"Entrada afegida correctament!"
				);
				return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
			}
		
		
		}
		return $this->redirect($this->generateUrl('guia'));
	}
	
	
	/**
	 * Obre formulari per editar el nivell indicat.
	 */
	public function editarAction($id)
	{
		list($info,$tam)=self::buscaInfo($id);
		return $this->render('PrincipalBundle:AdminGuia:editar.html.twig',
				array('info' => $info, 'tam'=> $tam)
		);
	}
	
	/**
	 * Edita l'entitat original amb les modificacions fetes.
	 * Comprovarà si existeix en primer lloc.
	 */
	public function editarConfirmarAction()
	{
		$request = $this->getRequest();
		if ($request->isMethod('POST')) {
	
			$original = $request->request->get('original');
			$part1 = $request->request->get('nivell');
			$part2=$request->request->get('suffix');
			$nivell=$part1.$part2;
			$b=self::comprovaExistencia($nivell);
	
			if ($b===true && $nivell!=$original) {
				$this->get('session')->getFlashBag()->add(
						'error',
						"Error! Aquest nou nivell ja existeix!"
				);
				return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
			}
			else{
				$em = $this->getDoctrine()->getManager();
	
				list($entity,$tam)=self::buscaInfo($original);
					
				$entity->setNivell($nivell);
				$entity->setTitol($request->request->get('titol'));
				$entity->setCodi($request->request->get('codi'));
				$entity->setData($request->request->get('data'));
				$entity->setVolum($request->request->get('volum'));
					
				$entity->setNomProductor($request->request->get('nomProductor'));
				$entity->setHistoriaProductor($request->request->get('historiaProductor'));
				$entity->setHistoriaArxivistica($request->request->get('historiaArxivistica'));
				$entity->setDadesIngres($request->request->get('dadesIngres'));
					
				$entity->setAbast($request->request->get('abast'));
				$entity->setOrganitzacio($request->request->get('organitzacio'));
				$entity->setInformacioUtilitzacio($request->request->get('informacioUtilitzacio'));
				$entity->setIncrements($request->request->get('increments'));
					
				$entity->setCondicionsAcces($request->request->get('condicionsAcces'));
				$entity->setCondicionsReproduccio($request->request->get('condicionsReproduccio'));
				$entity->setLlengues($request->request->get('llengues'));
				$entity->setCaracteristiques($request->request->get('caracteristiques'));
				$entity->setInstruments($request->request->get('intruments'));
					
				$entity->setExistenciaOriginals($request->request->get('existenciaOriginals'));
				$entity->setExistenciaReproduccions($request->request->get('existenciaReproduccio'));
				$entity->setDocumentacio($request->request->get('documentacio'));
				$entity->setBibliografia($request->request->get('bibliografia'));
					
				$entity->setNotes($request->request->get('notes'));
					
				$entity->setAutoria($request->request->get('autoria'));
				$entity->setFonts($request->request->get('fonts'));
				$entity->setRegles($request->request->get('regles'));
					
				$em = $this->getDoctrine()->getManager();
				$em->persist($entity);
				$em->flush();
					
				$this->get('session')->getFlashBag()->add(
						'success',
						"Entrada editada correctament!"
				);
				return $this->redirect($this->generateUrl('search', array('id' => $nivell)));
			}
	
	
		}
		return $this->redirect($this->generateUrl('guia'));
	}
	
	/**
	 * Obre formulari per editar en masa tots els subnivells.
	 */
	public function totsAction($id)
	{
		return $this->render('PrincipalBundle:AdminGuia:tots.html.twig',
				array('nodac' => $id)
		);
	}
	
	public function totsConfirmarAction()
	{
		$request = $this->getRequest();
		if ($request->isMethod('POST')) {
			
			$nodac = $request->request->get('nodac');
			$param=$request->request->get('param');
			$valor = $request->request->get('valor');
			
			$parts = explode('.', $nodac);
			$tam=sizeof($parts);
			
			$arrayGuia=array("Fons","Subfons","Grup","Serie","Ucomposta","Usimple","Uinstalacio");
			$em = $this->getDoctrine()->getManager();
			
			for ($num=$tam-2; $num <= 6; $num++ ) {
				$rep = $em->getRepository('ArxiuBundle:Guia'.$arrayGuia[$num]);
				$rep->updateParam($nodac, $param, $valor);
			}
			
			$this->get('session')->getFlashBag()->add(
					'success',
					"Nivells actualitzats correctament!"
			);
			return $this->redirect($this->generateUrl('search', array('id' => $nodac)));
		}
		return $this->redirect($this->generateUrl('guia'));
	}
	
	public function eliminarAction($id)
	{
		list($info,$tam)=self::buscaInfo($id);
		return $this->render('PrincipalBundle:AdminGuia:eliminar.html.twig',
				array('info' => $info, 'tam'=> $tam)
		);
	}
	
	public function eliminarConfirmarAction()
	{
		$request = $this->getRequest();
		if ($request->isMethod('POST')) {
		
			$nivell = $request->request->get('nivell');
			list($entity,$tam)=self::buscaInfo($nivell);
			
			$em = $this->getDoctrine()->getManager();
			$em->remove($entity);
			$em->flush();
			
			$this->get('session')->getFlashBag()->add(
					'success',
					"Nivell eliminat correctament!"
			);
			return $this->redirect($this->generateUrl('guia'));
		}
		return $this->redirect($this->generateUrl('guia'));
	}
	
	/**
	 * Busca la informació de l'entitat corresponent al identificador
	 */
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
	
	/**
	 * Comprova l'existencia del corresponent identificador
	 */
	private function comprovaExistencia($id){
	
		$em = $this->getDoctrine()->getManager();
		//es divideix l'identificador indicat per saber a quin nivell es troba
		$parts = explode('.', $id);
		$tam=sizeof($parts);
		$info=null;
	
		//obtenir la informacio del identificador indicat
		if($tam==2){
			$info = $em->getRepository('ArxiuBundle:GuiaFons')->findOneByNivell($id);
		}
		else if($tam==3){
			$info = $em->getRepository('ArxiuBundle:GuiaSubfons')->findOneByNivell($id);
		}
		else if($tam==4){
			$info = $em->getRepository('ArxiuBundle:GuiaGrup')->findOneByNivell($id);
		}
		else if($tam==5){
			$info = $em->getRepository('ArxiuBundle:GuiaSerie')->findOneByNivell($id);
		}
		else if($tam==6){
			$info = $em->getRepository('ArxiuBundle:GuiaUcomposta')->findOneByNivell($id);
		}
		else if($tam==7){
			$info = $em->getRepository('ArxiuBundle:GuiaUsimple')->findOneByNivell($id);
		}
		else if($tam==8){
			$info = $em->getRepository('ArxiuBundle:GuiaUinstalacio')->findOneByNivell($id);
		}
		
		if($info === null){
			return false;
		}
		else{
			return true;
		}
	
		return false;
	}
	
	/**
	 * Crea una entitat buida com la del indentificador donat.
	 */
	private function creaEntitat($id){
		$parts = explode('.', $id);
		$tam=sizeof($parts);
		$entitat=null;
		if($tam==2){
			$entitat= new GuiaFons();
		}
		else if($tam==3){
			$entitat= new GuiaSubfons();
		}
		else if($tam==4){
			$entitat= new GuiaGrup();
		}
		else if($tam==5){
			$entitat= new GuiaSerie();
		}
		else if($tam==6){
			$entitat= new GuiaUcomposta();
		}
		else if($tam==7){
			$entitat= new GuiaUsimple();
		}
		else if($tam==8){
			$entitat= new GuiaUinstalacio();
		}
		return $entitat;
	}
		
}