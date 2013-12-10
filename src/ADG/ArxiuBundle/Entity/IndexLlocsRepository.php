<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class IndexLlocsRepository extends EntityRepository
{

	public function findForLlistat($nom){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		
		$qb->select('DISTINCT i.nom')->from('ArxiuBundle:IndexLlocs', 'i');
		$qb->andWhere('i.nom LIKE :nom');
		$qb->setParameter('nom', '%'.$nom.'%');
		$q = $qb->getQuery();

		return $q->getResult();
	}
	
	public function findForNoms($nom){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('i.nodac, i.num, i.nom')->from('ArxiuBundle:IndexLlocs', 'i');
		$qb->andWhere('i.nom = :nom');
		$qb->setParameter('nom', $nom);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findDetalls($num , $nodac){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('i.nodac, i.nom')->from('ArxiuBundle:IndexLlocs', 'i');
		$qb->where('i.num = :num');
		$qb->setParameter('num', $num);
	
		$qb->orWhere('i.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
	
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findNodac($num){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$resultat="";
		$qb->select('i.nodac')->from('ArxiuBundle:IndexLlocs', 'i');
		$qb->where('i.num = :num');
		$qb->setParameter('num', $num);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		$r=$q->getResult();
		foreach ($r as $valor1){
			foreach ($valor1 as $valor2){
				$resultat=$valor2;
			}
		}
		return $resultat;
	}


}