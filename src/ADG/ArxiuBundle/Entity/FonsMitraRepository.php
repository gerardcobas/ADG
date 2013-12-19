<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsMitraRepository extends EntityRepository
{
	
	public function findForMitra($paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fm.num, fm.nodac, fm.dades')->from('ArxiuBundle:FonsMitra', 'fm');
		$qb->where('fm.dades LIKE :paraula');
		$qb->setParameter('paraula', '%'. $paraula . '%');

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
		$qb->select('f.num')->from('ArxiuBundle:FonsMitra', 'f');
	
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
	}
	
	public function findDetalls($num , $nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('i.nodac, i.data, i.dades, i.notari, i.mides, i.obs')
		->from('ArxiuBundle:FonsMitra', 'i');
	
		$qb->where('i.num = :num');
		$qb->setParameter('num', $num);
		$qb->orWhere('i.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
}