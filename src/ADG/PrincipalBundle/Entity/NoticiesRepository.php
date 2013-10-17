<?php

namespace ADG\PrincipalBundle\Entity;
use Doctrine\ORM\EntityRepository;

class NoticiesRepository extends EntityRepository
{
	public function findAll()
	{
		return $this->findBy(array(), array('data' => 'DESC'));
	}
	
	public function findByParamFuzzy($param, $name) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('n')->from('PrincipalBundle:Noticies', 'n');
	
		if ($param == 'titol') {
			$qb->where('n.titol LIKE :name');
		} else {
			$qb->where('n.' . $param . ' LIKE :name');
		}
	
		$qb->setParameter('name', '%' . $name . '%');
	
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	
}