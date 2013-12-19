<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsArxiusRepository extends EntityRepository
{
	
	public function findForArxius($prefix, $paraula, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fa.num, fa.nodac, fa.data, fa.dades')->from('ArxiuBundle:FonsArxius', 'fa');
		
		$qb->where('fa.num LIKE :prefix');
		$qb->andWhere('fa.dades LIKE :paraula');
		$qb->andWhere('fa.data LIKE :data');
		
		$qb->setParameter('prefix', $prefix . '%');
		$qb->setParameter('paraula', '%'. $paraula . '%');
		$qb->setParameter('data', '%'. $data . '%');
		
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
		$qb->select('i.nodac, i.data, i.dades, i.notari, i.mides, i.obs')
		->from('ArxiuBundle:FonsArxius', 'i');
	
		$qb->where('i.num = :num');
		$qb->setParameter('num', $num);
		$qb->orWhere('i.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}