<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaGrupRepository extends EntityRepository
{

	
	public function findByLike($grup) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('g')->from('ArxiuBundle:GuiaGrup', 'g');

		$qb->where('g.nivell LIKE :grup');
		
		
		//Genera format de grup (X.X.)
		$parts = explode('.', $grup);
		$qq=$parts[0].'.'.$parts[1].'.';
		$qb->setParameter('grup', $qq . '%');
	
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	
}