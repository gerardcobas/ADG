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
	
	
	public function findDetalls($num , $nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('i.nodac, i.institucio, i.foli')
		->from('ArxiuBundle:FonsLiberden', 'i');
	
		$qb->where('i.id = :num');
		$qb->setParameter('num', $num);
		$qb->orWhere('i.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}