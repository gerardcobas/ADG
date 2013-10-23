<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaUsimpleRepository extends EntityRepository
{


	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();

		// Build the query
		$qb->select('us.nivell, us.titol')->from('ArxiuBundle:GuiaUsimple', 'us');

		$qb->where('us.nivell LIKE :usim');

		//Genera format de subfons (X.X.X.X.X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.'.$parts[1].'.'.$parts[2].'.'.$parts[3].'.'.$parts[4].'.';
		$qb->setParameter('usim', $qq . '%');

		$q = $qb->getQuery();

		return $q->getResult();
	}


}