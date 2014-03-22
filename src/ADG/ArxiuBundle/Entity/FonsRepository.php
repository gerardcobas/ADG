<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsRepository extends EntityRepository
{
	
	public function findForFons($prefix, $paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('f.num, f.nodac, f.dades')->from('ArxiuBundle:Fons', 'f');
		
		$qb->where('f.num LIKE :prefix');
		$qb->andWhere('f.dades LIKE :paraula');
		
		$qb->setParameter('prefix', $prefix . '%');
		$qb->setParameter('paraula', '%'. $paraula . '%');
		$qb->setMaxResults(3721);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function findFonsManuals($paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('f.num, f.nodac, f.dades')->from('ArxiuBundle:Fons', 'f');
		$qb->where("(f.num>='D-152-00000' AND f.num<='D-503-99999')");
		$qb->andWhere('f.dades LIKE :paraula');
		$qb->setParameter('paraula', '%'. $paraula . '%');
		$qb->setMaxResults(3198);
	
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function findFonsBeneficis($paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('f.num, f.nodac, f.dades')->from('ArxiuBundle:Fons', 'f');
		$qb->where("((f.num LIKE 'D-001%') OR (f.num>='D-004-00000' AND f.num<='D-036-99999'))");
		$qb->andWhere('f.dades LIKE :paraula');
		$qb->setParameter('paraula', '%'. $paraula . '%');
		$qb->setMaxResults(3017);
	
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function findFonsFundacions($paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('f.num, f.nodac, f.dades')->from('ArxiuBundle:Fons', 'f');
		$qb->where("(f.num LIKE 'D-002%' OR f.num LIKE 'D-003%')");
		$qb->andWhere('f.dades LIKE :paraula');
		$qb->setParameter('paraula', '%'. $paraula . '%');
		$qb->setMaxResults(3017);
	
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function findFonsProcessos($paraula){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$qb->select('f.num, f.nodac, f.dades')->from('ArxiuBundle:Fons', 'f');
		$qb->where("(f.num>='A-038-00000' AND f.num<='A-163-99999')");
		$qb->andWhere('f.dades LIKE :paraula');
		$qb->setParameter('paraula', '%'. $paraula . '%');
		$qb->setMaxResults(3017);
	
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	/*
	 * Retorna un nou identificador, calculat a partir del ultim segons els prefix donat.
	*/
	public function findNewId($prefix){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('f.num')->from('ArxiuBundle:Fons', 'f');
	
		$qb->where('f.num LIKE :prefix');
	
		$qb->setParameter('prefix', $prefix . '%');
		$qb->orderBy('f.num', 'DESC');
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		$r=$q->getResult();
		if(empty($r)) {
			//comprovar si acaba amb -
			if(substr($prefix, -1) === '-'){
				$resultat=$prefix.'1';
			}
			else{
				$resultat=$prefix.'-'.'1';
			}
		}
		else{
			foreach ($r as $valor1){
				foreach ($valor1 as $valor2){
					$qr=$valor2;
				}
			}
			$parts = explode('-', $qr);
			
			$afegit= intval($parts[2])+1;
			$resultat=$parts[0].'-'.$parts[1].'-'.$afegit;
		}
		return $resultat;
	}
	
	public function findDetalls($num , $nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('i.nodac, i.dades, i.llibre, i.full')
					->from('ArxiuBundle:Fons', 'i');
	
		$qb->where('i.num = :num');
		$qb->setParameter('num', $num);
		if($nodac != "" and $nodac != null) {
			$qb->orWhere('i.nodac = :nodac');
			$qb->setParameter('nodac', $nodac);
		}
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	
}