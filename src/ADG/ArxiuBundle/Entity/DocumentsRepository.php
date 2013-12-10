<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class DocumentsRepository extends EntityRepository
{
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nodac, t.poblacio, t.data, t.descripcio, t.texte'
			)->from('ArxiuBundle:Documents', 't');
		
		$qb->orWhere('t.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	
}