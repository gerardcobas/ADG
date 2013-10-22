<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaFonsRepository extends EntityRepository
{

	
	public function findAll() {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('f.nivell, f.titol')->from('ArxiuBundle:GuiaFons', 'f');
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	
}