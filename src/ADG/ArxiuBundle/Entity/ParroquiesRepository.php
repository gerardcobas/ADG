<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class ParroquiesRepository extends EntityRepository
{

	public function findParroquies($nodac, $data, $nom, $paraula){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		
		$qb->select('p.id,p.nodac,p.data,p.nom,p.titol')->from('ArxiuBundle:Parroquies', 'p');
		$qb->where('p.nom LIKE :nom');
		$qb->setParameter('nom', '%'.$nom.'%');
		$qb->andWhere('p.nodac LIKE :nodac');
		$qb->setParameter('nodac', '%'.$nodac.'%');
		$qb->andWhere('p.data LIKE :data');
		$qb->setParameter('data', '%'.$data.'%');
		
		$qb->andWhere('(p.titol LIKE :paraula OR p.autors LIKE :paraula OR p.unitat LIKE :paraula OR p.volum LIKE :paraula OR p.notes LIKE :paraula 
				OR p.fitxa LIKE :paraula OR p.dataIngres LIKE :paraula)');
		$qb->setParameter('paraula', '%'.$paraula.'%');
		$q = $qb->getQuery();

		return $q->getResult();
	}

	
	public function findDetalls($nodac){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('p.nodac,p.data,p.nom,p.titol,p.unitat,p.volum,p.mides,p.cobertes,p.pagines,p.ambIndex,p.acces,p.notes,
				p.estat,p.llengua,p.autors,p.fitxa,p.dataIngres')->from('ArxiuBundle:Parroquies', 'p');
		$qb->where('p.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	


}