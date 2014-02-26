<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaFonsRepository extends EntityRepository
{

	
	public function findAll() {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('f.nivell, f.titol, LENGTH(f.nivell) AS long')->from('ArxiuBundle:GuiaFons', 'f');
		$qb->orderBy('long', 'ASC');
		
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nivell, t.codi, t.titol, t.data, t.volum, t.nomProductor, t.historiaProductor, t.historiaArxivistica, t.dadesIngres, t.abast,
				t.organitzacio, t.informacioUtilitzacio, t.increments, t.condicionsAcces, t.condicionsReproduccio, t.llengues, t.caracteristiques,
				t.instruments, t.existenciaOriginals, t.existenciaReproduccions, t.documentacio, t.bibliografia, t.notes, t.autoria, t.fonts, t.regles'
			)->from('ArxiuBundle:GuiaFons', 't');
		
		$qb->orWhere('t.nivell = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function updateParam($nivell, $param, $valor){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$em->createQuery('UPDATE ArxiuBundle:GuiaFons t SET t.'.$param.' = :valor WHERE t.nivell LIKE :nivell')
				->setParameter('valor', $valor)
				->setParameter('nivell', $nivell.'%')
	            ->execute();
	}
	
	
}