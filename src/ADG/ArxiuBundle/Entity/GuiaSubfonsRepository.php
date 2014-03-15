<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaSubfonsRepository extends EntityRepository
{

	
	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('s.nivell, s.titol, LENGTH(s.nivell) AS long')->from('ArxiuBundle:GuiaSubfons', 's');

		$qb->where('s.nivell LIKE :fons');
		$qb->orderBy('long', 'ASC');
		
		//Genera format de subfons (X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.';
		$qb->setParameter('fons', $qq . '%');
		$qb->setMaxResults(3530);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nivell, t.codi, t.titol, t.data, t.volum, t.nomProductor, t.historiaProductor, t.historiaArxivistica, t.dadesIngres, t.abast,
				t.organitzacio, t.informacioUtilitzacio, t.increments, t.condicionsAcces, t.condicionsReproduccio, t.llengues, t.caracteristiques,
				t.instruments, t.existenciaOriginals, t.existenciaReproduccions, t.documentacio, t.bibliografia, t.notes, t.autoria, t.fonts, t.regles'
		)->from('ArxiuBundle:GuiaSubfons', 't');
	
		$qb->orWhere('t.nivell = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function updateParam($nivell, $param, $valor){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$em->createQuery('UPDATE ArxiuBundle:GuiaSubfons t SET t.'.$param.' = :valor WHERE t.nivell LIKE :nivell')
		->setParameter('valor', $valor)
		->setParameter('nivell', $nivell.'%')
		->execute();
	}
}