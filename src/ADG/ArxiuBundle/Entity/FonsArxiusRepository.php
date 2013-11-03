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
	
}