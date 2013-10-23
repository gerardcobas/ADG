<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaUinstalacioRepository extends EntityRepository
{


	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();

		// Build the query
		$qb->select('ui.nivell, ui.titol')->from('ArxiuBundle:GuiaUinstalacio', 'ui');

		$qb->where('ui.nivell LIKE :uinst');

		//Genera format de subfons (X.X.X.X.X.X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.'.$parts[1].'.'.$parts[2].'.'.$parts[3].'.'.$parts[4].'.'.$parts[5].'.';
		$qb->setParameter('uinst', $qq . '%');

		$q = $qb->getQuery();

		return $q->getResult();
	}


}