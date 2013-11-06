<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class FonsSeminaristesRepository extends EntityRepository
{
	
	public function findForSeminaristes($nom, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fs.num, fs.nodac, fs.cognom')->from('ArxiuBundle:FonsSeminaristes', 'fs');
		
		$qb->where('fs.cognom LIKE :nom');
		$qb->andWhere('fs.data LIKE :data');
		
		$qb->setParameter('nom', '%'. $nom . '%');
		$qb->setParameter('data', '%'. $data . '%');
		
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findForSeminaristesEstricta($nom, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('fs.num, fs.nodac, fs.cognom')->from('ArxiuBundle:FonsSeminaristes', 'fs');
	
		if ($nom!=null && $nom !="") {
			$qb->where('fs.cognom = :nom');
			$qb->setParameter('nom', $nom );
		}
		if ($data!=null && $data !="") {
			$qb->andWhere('fs.ordenacio = :data');
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
		$qb->select('f.num')->from('ArxiuBundle:FonsSeminaristes', 'f');
	
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
		$resultat=$parts[0].'-'.$parts[1].'-'.$afegit;
	
		return $resultat;
	}
}