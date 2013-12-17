<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class ParroquiesRepository extends EntityRepository
{

	public function findParroquies($nom){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		
		$qb->select('p.id, p.nom, p.descripcio')->from('ArxiuBundle:Parroquies', 'p');
		$qb->where('p.nom LIKE :nom OR p.descripcio LIKE :nom');
		$qb->setParameter('nom', '%'.$nom.'%');
		
		$q = $qb->getQuery();

		return $q->getResult();
	}
	
	public function findNom($id){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('p.nom')->from('ArxiuBundle:Parroquies', 'p');
		$qb->where('p.id = :id');
		$qb->setParameter('id', $id);
		
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		$r=$q->getResult();
		$resultat='';
		foreach ($r as $valor1){
			foreach ($valor1 as $valor2){
				$resultat=$valor2;
			}
		}
		return $resultat;
	}


}