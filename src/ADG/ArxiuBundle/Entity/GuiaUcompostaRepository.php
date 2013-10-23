<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaUcompostaRepository extends EntityRepository
{

	
	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('uc.nivell, uc.titol')->from('ArxiuBundle:GuiaUcomposta', 'uc');

		$qb->where('uc.nivell LIKE :ucomp');
		
		//Genera format de subfons (X.X.X.X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.'.$parts[1].'.'.$parts[2].'.'.$parts[3].'.';
		$qb->setParameter('ucomp', $qq . '%');
	
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	
}
