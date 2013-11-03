<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsLiberdenRepository extends EntityRepository
{
	
	public function findForLiberden($paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fl.id, fl.nodac, fl.institucio, fl.foli')->from('ArxiuBundle:FonsLiberden', 'fl');
		$qb->where('fl.institucio LIKE :paraula');
		$qb->setParameter('paraula', '%'. $paraula . '%');

		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}