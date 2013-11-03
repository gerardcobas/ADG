<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsRepository extends EntityRepository
{
	
	public function findForFons($prefix, $paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('f.num, f.nodac, f.dades')->from('ArxiuBundle:Fons', 'f');
		
		$qb->where('f.num LIKE :prefix');
		$qb->andWhere('f.dades LIKE :paraula');
		
		$qb->setParameter('prefix', $prefix . '%');
		$qb->setParameter('paraula', '%'. $paraula . '%');

		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}