<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class GuiaUcompostaRepository extends EntityRepository
{

	
	public function findByLike($id) {
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		// Build the query
		$qb->select('uc.nivell, uc.titol, LENGTH(uc.nivell) AS long')->from('ArxiuBundle:GuiaUcomposta', 'uc');

		$qb->where('uc.nivell LIKE :ucomp');
		$qb->orderBy('long', 'ASC');
		
		//Genera format de subfons (X.X.X.X.)
		$parts = explode('.', $id);
		$qq=$parts[0].'.'.$parts[1].'.'.$parts[2].'.'.$parts[3].'.';
		$qb->setParameter('ucomp', $qq . '%');
	
		$q = $qb->getQuery();
	
		return $q->getResult();
	}
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nivell, t.codi, t.titol, t.data, t.volum, t.nomProductor, t.historiaProductor, t.historiaArxivistica, t.dadesIngres, t.abast,
				t.organitzacio, t.informacioUtilitzacio, t.increments, t.condicionsAcces, t.condicionsReproduccio, t.llengues, t.caracteristiques,
				t.instruments, t.existenciaOriginals, t.existenciaReproduccions, t.documentacio, t.bibliografia, t.notes, t.autoria, t.fonts, t.regles'
		)->from('ArxiuBundle:GuiaUcomposta', 't');
	
		$qb->orWhere('t.nivell = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function updateParam($nivell, $param, $valor){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
	
		$em->createQuery('UPDATE ArxiuBundle:GuiaUcomposta t SET t.'.$param.' = :valor WHERE t.nivell LIKE :nivell')
		->setParameter('valor', $valor)
		->setParameter('nivell', $nivell.'%')
		->execute();
	}
}
