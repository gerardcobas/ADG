<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsMongesRepository extends EntityRepository
{
	
	public function findForMonges($nom, $lloc, $congregacio){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fm.num, fm.nodac, fm.cognom, fm.fitxa')->from('ArxiuBundle:FonsMonges', 'fm');
		
		$qb->where('fm.cognom LIKE :nom');
		$qb->andWhere('fm.naturalDe LIKE :lloc');
		$qb->andWhere('fm.congregacio LIKE :congregacio');
		
		$qb->setParameter('nom', '%'. $nom . '%');
		$qb->setParameter('lloc', '%'. $lloc . '%');
		$qb->setParameter('congregacio', '%'. $congregacio . '%');
		$qb->setMaxResults(4378);
		
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findForMongesEstricta($nom, $lloc, $congregacio){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fm.num, fm.nodac, fm.cognom, fm.fitxa')->from('ArxiuBundle:FonsMonges', 'fm');
		$qb->setMaxResults(4378);
		if ($nom!=null && $nom !="") {
			$qb->where('fm.cognom = :nom');
			$qb->setParameter('nom', $nom );
		}
		if ($lloc!=null && $lloc !="") {
			$qb->andWhere('fm.naturalDe = :lloc');
			$qb->setParameter('lloc', $lloc);
		}
		if ($congregacio!=null && $congregacio !="") {
			$qb->andWhere('fm.congregacio = :congregacio');
			$qb->setParameter('congregacio', $congregacio);
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
		$qb->select('f.num')->from('ArxiuBundle:FonsMonges', 'f');
	
		$qb->where('f.num LIKE :prefix');
	
		$qb->setParameter('prefix', $prefix . '%');
		$qb->orderBy('f.num', 'DESC');
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		$r=$q->getResult();
		if(empty($r)) {
			$resultat=$prefix.'1';
		}
		else{
			foreach ($r as $valor1){
				foreach ($valor1 as $valor2){
					$qr=$valor2;
				}
			}
			$parts = explode('-', $qr);
			
			$afegit= intval($parts[2])+1;
			$resultat=$parts[0].'-'.$parts[1].'-'.$afegit;
		}
		return $resultat;
	}
	
	
	public function findDetalls($num , $nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('i.nodac, i.data, i.cognom, i.naturalDe, i.congregacio, i.llocCongregacio, i.fitxa')
		->from('ArxiuBundle:FonsMonges', 'i');
	
		$qb->where('i.num = :num');
		$qb->setParameter('num', $num);
		if($nodac != "" and $nodac != null) {
			$qb->orWhere('i.nodac = :nodac');
			$qb->setParameter('nodac', $nodac);
		}
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
}