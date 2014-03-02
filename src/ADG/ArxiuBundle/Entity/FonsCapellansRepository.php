<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsCapellansRepository extends EntityRepository
{
	
	public function findForCapellans($nom, $lloc, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fc.num, fc.nodac, fc.cognom, fc.fitxa')->from('ArxiuBundle:FonsCapellans', 'fc');
		$qb->setMaxResults(3934);
		$qb->where('fc.cognom LIKE :nom');
		$qb->andWhere('fc.naturalDe LIKE :lloc');
		$qb->andWhere('fc.ordenacio LIKE :data');
		
		$qb->setParameter('nom', '%'. $nom . '%');
		$qb->setParameter('lloc', '%'. $lloc . '%');
		$qb->setParameter('data', '%'. $data . '%');
		
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findForCapellansEstricta($nom, $lloc, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fc.num, fc.nodac, fc.cognom, fc.fitxa')->from('ArxiuBundle:FonsCapellans', 'fc');
		$qb->setMaxResults(3934);
		if ($nom!=null && $nom !="") {
			$qb->where('fc.cognom = :nom');
			$qb->setParameter('nom', $nom );
		}
		if ($lloc!=null && $lloc !="") {
			$qb->andWhere('fc.naturalDe = :lloc');
			$qb->setParameter('lloc', $lloc);
		}
		if ($data!=null && $data !="") {
			$qb->andWhere('fc.ordenacio = :data');
			$qb->setParameter('data', $data);
		}
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
		$qb->select('f.num')->from('ArxiuBundle:FonsCapellans', 'f');
	
		$qb->where('f.num LIKE :prefix');
	
		$qb->setParameter('prefix', $prefix . '%');
		$qb->orderBy('f.num', 'DESC');
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		$r=$q->getResult();
		if(empty($r)) {
			$resultat=$prefix.'1';
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
		$qb->select('i.nodac, i.dataNaixement, i.cognom, i.naturalDe, i.ordenacio, i.dataObit, i.fitxa, i.altres')
		->from('ArxiuBundle:FonsCapellans', 'i');
	
		$qb->where('i.num = :num');
		$qb->setParameter('num', $num);
		$qb->orWhere('i.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
}