<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsTestamentsRepository extends EntityRepository
{
	
	public function findForTestaments($prefix, $paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('ft.num, ft.nodac, ft.dades')->from('ArxiuBundle:FonsTestaments', 'ft');
		
		$qb->where('ft.num LIKE :prefix');
		$qb->andWhere('ft.dades LIKE :paraula');
		
		$qb->setParameter('prefix', $prefix . '%');
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
		$qb->select('f.num')->from('ArxiuBundle:FonsTestaments', 'f');
	
		$qb->where('f.num LIKE :prefix');
	
		$qb->setParameter('prefix', $prefix . '%');
		$qb->orderBy('f.num', 'DESC');
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