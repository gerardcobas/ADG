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
	
		if ($maNom!=null && $maNom !="") {
			$qb->where('d.maritNom = :maNom');
			$qb->setParameter('maNom', $maNom );
		}
		
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	
	/*
	 * Retorna un nou identificador, calculat a partir del ultim segons els prefix donat.
	 */
	public function findNewId($prefix){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fa.num')->from('ArxiuBundle:FonsArxius', 'fa');
	
		$qb->where('fa.num LIKE :prefix');
	
		$qb->setParameter('prefix', $prefix . '%');
		$qb->orderBy('fa.num', 'DESC');
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		$r=$q->getResult();
		foreach ($r as $valor1){
			foreach ($valor1 as $valor2){
					$qr=$valor2;
			}
		}
		$parts = explode('-', $qr);
		
		$afegit= intval($parts[2])+1;
		$resultat=$parts[0].'-'.$parts[1].'-'.$afegit;
		
		return $resultat;
	}
	
}