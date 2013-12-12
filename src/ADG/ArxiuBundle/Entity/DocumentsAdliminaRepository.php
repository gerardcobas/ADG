<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class DocumentsAdliminaRepository extends EntityRepository
{
	

	public function findAdlimina($poblacio, $paraula, $nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.id, t.nodac, t.titol, t.texte'
		)->from('ArxiuBundle:DocumentsAdlimina', 't');
	
		$qb->where('t.poblacio = :poblacio');
		$qb->setParameter('poblacio', $poblacio);
		
		$qb->andWhere('t.nodac LIKE :nodac');
		$qb->setParameter('nodac', '%'.$nodac.'%');
		
		$qb->andWhere('(t.texte LIKE :paraula OR t.titol LIKE :paraula)');
		$qb->setParameter('paraula', '%'.$paraula.'%');

		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nodac, t.titol, t.texte'
			)->from('ArxiuBundle:DocumentsAdlimina', 't');
		
		$qb->where('t.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	
}