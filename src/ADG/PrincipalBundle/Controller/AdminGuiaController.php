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
    					"Ja existeix!"
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