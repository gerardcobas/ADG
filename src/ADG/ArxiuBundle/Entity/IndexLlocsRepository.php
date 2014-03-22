<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class IndexLlocsRepository extends EntityRepository
{

	public function findForLlistat($nom){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		
		$qb->select('DISTINCT i.nom')->from('ArxiuBundle:IndexLlocs', 'i');
		$qb->andWhere('i.nom LIKE :nom OR i.nodac LIKE :nom');
		$qb->setParameter('nom', '%'.$nom.'%');
		$qb->setMaxResults(3852);
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
	
	public function findDetalls($nom, $num , $nodac){
	
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('i.nodac, i.nom')->from('ArxiuBundle:IndexLlocs', 'i');
		$qb->where('i.num = :num and i.nom = :nom');
		$qb->setParameter('num', $num);
		$qb->setParameter('nom', $nom);
		
		if($nodac != "" and $nodac != null) {
			$qb->orWhere('i.nodac = :nodac');
			$qb->setParameter('nodac', $nodac);
		}
	
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

	/*
	 * Retorna un nou identificador, calculat a partir del ultim segons els prefix donat.
	*/
	public function findNewId($prefix){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('f.num')->from('ArxiuBundle:IndexLlocs', 'f');
	
		$qb->where('f.num LIKE :prefix');
	
		$qb->setParameter('prefix', $prefix . '%');
		$qb->orderBy('f.num', 'DESC');
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		$r=$q->getResult();
		foreach ($r as $valor1){
			foreach ($valor1 as $valor2){
				$qr=$valor2;
			}
		}
		$parts = explode('-', $qr);
	
		$afegit= intval($parts[2])+1;
	
		$p0='Lloc';
		$p1='001';
		if ($parts[0] != null and $parts[0] != '') $p0=$parts[0];
		if ($parts[1] != null and $parts[1] != '') $p1=$parts[1];
	
		$resultat=$p0.'-'.$p1.'-'.$afegit;
	
		return $resultat;
	}

}