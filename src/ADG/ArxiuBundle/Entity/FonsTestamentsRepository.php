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
	
}