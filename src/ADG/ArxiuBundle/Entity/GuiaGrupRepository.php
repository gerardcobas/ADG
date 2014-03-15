<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaGrupRepository extends EntityRepository
{

	
	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('g.nivell, g.titol, LENGTH(g.nivell) AS long')->from('ArxiuBundle:GuiaGrup', 'g');

		$qb->where('g.nivell LIKE :grup');
		$qb->orderBy('long', 'ASC');
		
		//Genera format de grup (X.X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.'.$parts[1].'.';
		$qb->setParameter('grup', $qq . '%');
		$qb->setMaxResults(3869);
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nivell, t.codi, t.titol, t.data, t.volum, t.nomProductor, t.historiaProductor, t.historiaArxivistica, t.dadesIngres, t.abast,
				t.organitzacio, t.informacioUtilitzacio, t.increments, t.condicionsAcces, t.condicionsReproduccio, t.llengues, t.caracteristiques,
				t.instruments, t.existenciaOriginals, t.existenciaReproduccions, t.documentacio, t.bibliografia, t.notes, t.autoria, t.fonts, t.regles'
		)->from('ArxiuBundle:GuiaGrup', 't');
	
		$qb->orWhere('t.nivell = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function updateParam($nivell, $param, $valor){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$em->createQuery('UPDATE ArxiuBundle:GuiaGrup t SET t.'.$param.' = :valor WHERE t.nivell LIKE :nivell')
		->setParameter('valor', $valor)
		->setParameter('nivell', $nivell.'%')
		->execute();
	}
}