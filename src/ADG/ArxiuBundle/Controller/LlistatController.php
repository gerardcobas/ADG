<?php

namespace ADG\ArxiuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LlistatController extends Controller
{
    public function llistatAction()
    {
        return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
    		array('info'=>null,'noms'=>NULL,'tipus'=>'persona', 'paraula'=>'', 'select'=>"llista")	
        );
    }
    
    public function cercaAction()
    {
    	$request = $this->getRequest();
    	$noms=null;
    	if ($request->isMethod('POST')) {
    		$cercaTipus=$request->request->get('cercaTipus');
    		$paraula=$request->request->get('paraula');
    		$em = $this->getDoctrine()->getManager();
    		
    		if ($cercaTipus=="persona") {
    			$rep = $em->getRepository('ArxiuBundle:IndexPersones');
    			$noms=$rep->findForLlistat($paraula);
    			$tipus='persona';
    		}
    		else{
    			$rep = $em->getRepository('ArxiuBundle:IndexLlocs');
    			$noms=$rep->findForLlistat($paraula);
    			$tipus='lloc';
    		}
    	}
    	
    	return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
    			array('info'=>null,'noms'=>$noms,'tipus'=>$tipus, 'paraula'=>$paraula, 'select'=>"llista")
    	);
    }
    
    public function veurePersonaAction($nom)
    {
    	$info=null;
		$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:IndexPersones'); 
    	$info=$rep->findForNoms($nom);
    	return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
    			array('info'=>$info,'noms'=>null,'tipus'=>"persona", 'paraula'=>'', 'select'=>"detall")
    	);
    }
    
    public function veureLlocAction($nom)
    {
    	$info=null;
    	$em = $this->getDoctrine()->getManager();
    	$rep = $em->getRepository('ArxiuBundle:IndexLlocs');
    	$info=$rep->findForNoms($nom);
    	return $this->render('ArxiuBundle:Llistat:llistat.html.twig',
    			array('info'=>$info,'noms'=>null,'tipus'=>"lloc", 'paraula'=>'', 'select'=>"detall")
    	);
    }
    
    public function detallAction($id)
    {

    	/* OPCIO 1: Identificar prefix del num de ref Ex:"P-001-xxxx" i fer forward al controlador que correspongui
    	 * fonsarxius - P-00*
    	 * dispenses - D
    	 * PROBLEMA: Hi han repetits i no sempre corresponen a una sola taula
    	 */
    	
    	/* OPCIO 2: Buscar en totes les taules fins trobat coincidencia, si no hi ha, dir que no s'ha trobat.
    	 * Donar prioritat al nodac nou.
    	 */
    	
    	$guiaNodac=array("GuiaFons", "GuiaSubfons", "GuiaGrup", "GuiaSerie", "GuiaUcomposta", "GuiaUsimple", "GuiaUinstalacio", 
    			"Documents", "DocumentsAdlimina");
		//afegir parroquies!!
    	
    	$ambTot=array("Dispenses", "Fons", "FonsArxius", "FonsCapellans", "FonsMitra", "FonsMonges", 
    			"FonsSeminaristes", "FonsTestaments", "FonsLiberden", "IndexLlocs", "IndexPersones"); //index llocs i persones l'ultim per mostrar algo sempre

    	$info=null;
    	$em = $this->getDoctrine()->getManager();

    	//buscar nodac a persones/llocs amb l'id
    	$nodac = $em->getRepository('ArxiuBundle:IndexPersones')->findNodac($id);
    	if ($nodac == null or $nodac=="") {
    		$nodac = $em->getRepository('ArxiuBundle:IndexLlocs')->findNodac($id);
    	}
    	
    	if ($nodac != null and $nodac!="") {
    		//comprova els de nodac
    	    foreach ($guiaNodac as $g){
	    		$info = $em->getRepository('ArxiuBundle:'.$g)->findDetalls($nodac);
	    		if ($info != null and $info !="") {
	    			return $this->render('ArxiuBundle:Llistat:detall.html.twig', array('info'=>$info));
	    		}
    		}
    	}

    	//busca per num antic i per nodac
    	foreach ($ambTot as $t){
    		$info = $em->getRepository('ArxiuBundle:'.$t)->findDetalls($id, $nodac);
    		if ($info != null and $info !="") {
    			return $this->render('ArxiuBundle:Llistat:detall.html.twig', array('info'=>$info));
    		}
    	}
		    	
    	return $this->render('ArxiuBundle:Llistat:detall.html.twig',
    			array('info'=>$info)
    	);
    }
    
}
