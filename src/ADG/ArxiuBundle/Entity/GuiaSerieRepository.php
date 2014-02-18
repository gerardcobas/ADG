<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaSerieRepository extends EntityRepository
{

	
	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('se.nivell, se.titol, LENGTH(se.nivell) AS long')->from('ArxiuBundle:GuiaSerie', 'se');

		$qb->where('se.nivell LIKE :serie');
		$qb->orderBy('long', 'ASC');
		
		//Genera format de subfons (X.X.X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.'.$parts[1].'.'.$parts[2].'.';
		$qb->setParameter('serie', $qq . '%');
	
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nivell, t.codi, t.titol, t.data, t.volum, t.nomProductor, t.historiaProductor, t.historiaArxivistica, t.dadesIngres, t.abast,
				t.organitzacio, t.informacioUtilitzacio, t.increments, t.condicionsAcces, t.condicionsReproduccio, t.llengues, t.caracteristiques,
				t.instruments, t.existenciaOriginals, t.existenciaReproduccions, t.documentacio, t.bibliografia, t.notes, t.autoria, t.fonts, t.regles'
		)->from('ArxiuBundle:GuiaSerie', 't');
	
		$qb->orWhere('t.nivell = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	
}