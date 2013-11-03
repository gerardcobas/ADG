<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsSeminaristesRepository extends EntityRepository
{
	
	public function findForSeminaristes($nom, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fs.num, fs.nodac, fs.cognom')->from('ArxiuBundle:FonsSeminaristes', 'fs');
		
		$qb->where('fs.cognom LIKE :nom');
		$qb->andWhere('fs.data LIKE :data');
		
		$qb->setParameter('nom', '%'. $nom . '%');
		$qb->setParameter('data', '%'. $data . '%');
		
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}