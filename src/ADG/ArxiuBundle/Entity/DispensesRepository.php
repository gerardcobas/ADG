<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class DispensesRepository extends EntityRepository
{
	
	public function findTot($maNom, $maCog, $maCog2, $maNaix, $maRes,
    		 $muNom, $muCog, $muCog2, $muNaix, $muRes,
    		 $any, $interval1, $interval2, $param){
		
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		
		// Build the query
		$qb->select('d.numref, d.nodac, d.any, d.maritNom, d.maritCognom1, d.mullerNom, d.mullerCognom1')->from('ArxiuBundle:Dispenses', 'd');
		$qb->setMaxResults(1653);
		$qb->where('d.maritNom LIKE :maNom');
		$qb->andWhere('d.maritCognom1 LIKE :maCog');
		$qb->andWhere('d.maritCognom2 LIKE :maCog2');
		$qb->andWhere('d.maritLlocNaixement LIKE :maNaix');
		$qb->andWhere('d.maritVeinatge LIKE :maRes');
		
		$qb->andWhere('d.mullerNom LIKE :muNom');
		$qb->andWhere('d.mullerCognom1 LIKE :muCog');
		$qb->andWhere('d.mullerCognom2 LIKE :muCog2');
		$qb->andWhere('d.mullerLlocNaixement LIKE :muNaix');
		$qb->andWhere('d.mullerVeinatge LIKE :muRes');
		
		$qb->setParameter('maNom', '%'.  $maNom . '%');
		$qb->setParameter('maCog', '%'.  $maCog . '%');
		$qb->setParameter('maCog2', '%'.  $maCog2 . '%');
		$qb->setParameter('maNaix', '%'.  $maNaix . '%');
		$qb->setParameter('maRes', '%'.  $maRes . '%');
		
		$qb->setParameter('muNom', '%'.  $muNom . '%');
		$qb->setParameter('muCog', '%'.  $muCog . '%');
		$qb->setParameter('muCog2', '%'.  $muCog2 . '%');
		$qb->setParameter('muNaix', '%'.  $muNaix . '%');
		$qb->setParameter('muRes', '%'.  $muRes . '%');

		if ($interval1!=null && $interval1 !="" && $interval2!=null && $interval2 !="" ) {
			$qb->andWhere('d.any BETWEEN :interval1 AND :interval2');
			$qb->setParameter('interval1',  $interval1);
			$qb->setParameter('interval2',  $interval2);
		}
		else if($any!=null && $any !="" ){
			
			if($param=='exacte'){
				$qb->andWhere('d.any = :any');
				$qb->setParameter('any', $any );
			}
			else if($param=='2'){
				$inici=intval($any)-2;
				$fin=intval($any)+2;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='5'){
				$inici=intval($any)-5;
				$fin=intval($any)+5;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='10'){
				$inici=intval($any)-10;
				$fin=intval($any)+10;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='20'){
				$inici=intval($any)-20;
				$fin=intval($any)+20;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='abans'){
				$qb->andWhere('d.any < :any ');
				$qb->setParameter('any',  $any);
			}
			else if($param=='despres'){
				$qb->andWhere('d.any > :any ');
				$qb->setParameter('any',  $any);
			}
			
		}
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findTotEstricta($maNom, $maCog, $maCog2, $maNaix, $maRes,
    		 $muNom, $muCog, $muCog2, $muNaix, $muRes,
    		 $any, $interval1, $interval2, $param){
		
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('d.numref, d.nodac, d.any, d.maritNom, d.maritCognom1, d.mullerNom, d.mullerCognom1')->from('ArxiuBundle:Dispenses', 'd');
		$qb->setMaxResults(1579);
		
		if ($maNom!=null && $maNom !="") {
			$qb->where('d.maritNom = :maNom');
			$qb->setParameter('maNom', $maNom );
		}
		if ($maCog!=null && $maCog !="") {
			$qb->andWhere('d.maritCognom1 LIKE :maCog');
			$qb->setParameter('maCog', $maCog );
		}
		if ($maCog2!=null && $maCog2 !="") {
			$qb->andWhere('d.maritCognom2 LIKE :maCog2');
			$qb->setParameter('maCog2', $maCog2 );
		}
		if ($maNaix!=null && $maNaix !="") {
			$qb->andWhere('d.maritLlocNaixement LIKE :maNaix');
			$qb->setParameter('maNaix', $maNaix );
		}
		if ($maRes!=null && $maRes !="") {
			$qb->andWhere('d.maritVeinatge LIKE :maRes');
			$qb->setParameter('maRes', $maRes );
		}
		if ($muNom!=null && $muNom !="") {
			$qb->andWhere('d.mullerNom LIKE :muNom');
			$qb->setParameter('muNom', $muNom );
		}
		if ($muCog!=null && $muCog !="") {
			$qb->andWhere('d.mullerCognom1 LIKE :muCog');
			$qb->setParameter('muCog', $muCog );
		}	
		if ($muCog2!=null && $muCog2 !="") {
			$qb->andWhere('d.mullerCognom2 LIKE :muCog2');
			$qb->setParameter('muCog2', $muCog2 );
		}
		if ($muNaix!=null && $muNaix !="") {
			$qb->andWhere('d.mullerLlocNaixement LIKE :muNaix');
			$qb->setParameter('muNaix', $muNaix );
		}
		if ($muRes!=null && $muRes !="") {
			$qb->andWhere('d.mullerVeinatge LIKE :muRes');
			$qb->setParameter('muRes', $muRes );
		}
		
		if ($interval1!=null && $interval1 !="" && $interval2!=null && $interval2 !="" ) {
			$qb->andWhere('d.any BETWEEN :interval1 AND :interval2');
			$qb->setParameter('interval1',  $interval1);
			$qb->setParameter('interval2',  $interval2);
		}
		else if($any!=null && $any !="" ){
				
			if($param=='exacte'){
				$qb->andWhere('d.any = :any');
				$qb->setParameter('any', $any );
			}
			else if($param=='2'){
				$inici=intval($any)-2;
				$fin=intval($any)+2;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='5'){
				$inici=intval($any)-5;
				$fin=intval($any)+5;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='10'){
				$inici=intval($any)-10;
				$fin=intval($any)+10;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='20'){
				$inici=intval($any)-20;
				$fin=intval($any)+20;
				$qb->andWhere('d.any BETWEEN :inici AND :fin');
				$qb->setParameter('inici',  strval($inici));
				$qb->setParameter('fin',  strval($fin));
			}
			else if($param=='abans'){
				$qb->andWhere('d.any < :any ');
				$qb->setParameter('any',  $any);
			}
			else if($param=='despres'){
				$qb->andWhere('d.any > :any ');
				$qb->setParameter('any',  $any);
			}
				
		}
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function findTotCognom($paraula, $cognom, $grau){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$info=array();
	
		// part1
		$qb->select('d.maritCognom1 as cognom')->from('ArxiuBundle:Dispenses', 'd');
		$qb->andWhere('d.maritCognom1 LIKE :maCog');
		$qb->setParameter('maCog', '%'.  $paraula . '%');
		$qb->setMaxResults(2500);
		$q = $qb->getQuery();
		$r1=$q->getResult();
		foreach ($r1 as $row){
			foreach ($row as $valor){
				$info[]=$valor;
			}
		}
		// part2
		$qb->select('d2.maritCognom2 as cognom')->from('ArxiuBundle:Dispenses', 'd2');
		$qb->andWhere('d2.maritCognom2 LIKE :maCog2');
		$qb->setParameter('maCog2', '%'.  $paraula . '%');
		$qb->setMaxResults(2500);
		$q = $qb->getQuery();
		$r2=$q->getResult();
		foreach ($r2 as $row){
			foreach ($row as $valor){
				$info[]=$valor;
			}
		}
		// part3
		$qb->select('d3.mullerCognom1 as cognom')->from('ArxiuBundle:Dispenses', 'd3');
		$qb->andWhere('d3.mullerCognom1 LIKE :muCog');
		$qb->setParameter('muCog', '%'.  $paraula . '%');
		$qb->setMaxResults(2500);
		$q = $qb->getQuery();
		$r3=$q->getResult();
		foreach ($r3 as $row){
			foreach ($row as $valor){
				$info[]=$valor;
			}
		}
		// part4
		$qb->select('d4.mullerCognom2 as cognom')->from('ArxiuBundle:Dispenses', 'd4');
		$qb->andWhere('d4.mullerCognom2 LIKE :muCog2');
		$qb->setParameter('muCog2', '%'.  $paraula . '%');
		$qb->setMaxResults(2500);
		$q = $qb->getQuery();
		$r4=$q->getResult();
		foreach ($r4 as $row){
			foreach ($row as $valor){
				$info[]=$valor;
			}
		}
		$result = array_unique($info);
		
		if($cognom!=null && $cognom !="") {
			$semblants=array();
			foreach ($info as $i){
				$g=3;
				if($grau=="baixa") $g=4;
				else if($grau=="mitjana") $g=3;
				else if($grau=="alta") $g=2;	
			
				if (levenshtein($i, $cognom) < $g && $i != $cognom) {
					$semblants[] = $i;
				}
			}
			$uniq = array_unique($semblants);
			return array_filter($uniq);
		}
		
		return array_filter($result);
	}
	
	public function findDetalls($num , $nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('i.nodac, i.data, i.any, i.tipus, i.control,
				i.maritNom, i.maritCognom1, i.maritCognom2, i.maritEstatCivil, i.maritOfici, i.maritNacionalitat, i.maritLlocNaixement, i.maritVeinatge,
				i.mullerNom, i.mullerCognom1, i.mullerCognom2, i.mullerEstatCivil, i.mullerOfici, i.mullerNacionalitat, i.mullerLlocNaixement, i.mullerVeinatge')
		->from('ArxiuBundle:Dispenses', 'i');
		
		$qb->where('i.numref = :num');
		$qb->setParameter('num', $num);
		if($nodac != "" and $nodac != null) {
			$qb->orWhere('i.nodac = :nodac');
			$qb->setParameter('nodac', $nodac);
		}
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findNewControl(){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('d.control')->from('ArxiuBundle:Dispenses', 'd');

		$qb->orderBy('d.control', 'DESC');
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		$r=$q->getResult();
		$res=1;
		foreach ($r as $valor1){
			foreach ($valor1 as $valor2){
				$res=$valor2;
			}
		}
		$resultat=intval($res)+1;
		return $resultat.'';
	}
	
}