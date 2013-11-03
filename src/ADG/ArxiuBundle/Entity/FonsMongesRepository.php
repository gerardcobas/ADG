<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsMongesRepository extends EntityRepository
{
	
	public function findForMonges($nom, $lloc, $congregacio){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fm.num, fm.nodac, fm.cognom, fm.fitxa')->from('ArxiuBundle:FonsMonges', 'fm');
		
		$qb->where('fm.cognom LIKE :nom');
		$qb->andWhere('fm.natural LIKE :lloc');
		$qb->andWhere('fm.congregacio LIKE :congregacio');
		
		$qb->setParameter('nom', '%'. $nom . '%');
		$qb->setParameter('lloc', '%'. $lloc . '%');
		$qb->setParameter('congregacio', '%'. $congregacio . '%');
		
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}