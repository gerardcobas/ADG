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
	
}