<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaSerieRepository extends EntityRepository
{

	
	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('se.nivell, se.titol')->from('ArxiuBundle:GuiaSerie', 'se');

		$qb->where('se.nivell LIKE :serie');
		
		//Genera format de subfons (X.X.X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.'.$parts[1].'.'.$parts[2].'.';
		$qb->setParameter('serie', $qq . '%');
	
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	
}