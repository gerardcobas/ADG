<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaSubfonsRepository extends EntityRepository
{

	
	public function findByLike($fons) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('s.nivell, s.titol')->from('ArxiuBundle:GuiaSubfons', 's');

		$qb->where('s.nivell LIKE :fons');
		
		//Genera format de subfons (X.)
		$parts = explode('.', $fons);
		$qq=$parts[0].'.';
		$qb->setParameter('fons', $qq . '%');
	
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	
}