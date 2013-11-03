<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsCapellansRepository extends EntityRepository
{
	
	public function findForCapellans($nom, $lloc, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fc.num, fc.nodac, fc.cognom, fc.fitxa')->from('ArxiuBundle:FonsCapellans', 'fc');
		
		$qb->where('fc.cognom LIKE :nom');
		$qb->andWhere('fc.natural LIKE :lloc');
		$qb->andWhere('fc.ordenacio LIKE :data');
		
		$qb->setParameter('nom', '%'. $nom . '%');
		$qb->setParameter('lloc', '%'. $lloc . '%');
		$qb->setParameter('data', '%'. $data . '%');
		
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}