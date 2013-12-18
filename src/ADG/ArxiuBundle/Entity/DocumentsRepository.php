<?php

namespace ADG\ArxiuBundle\Entity;
use Doctrine\ORM\EntityRepository;

class DocumentsRepository extends EntityRepository
{
	
	public function findDocuments($poblacio, $paraula, $nodac, $data){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.codiDoc, t.nodac, t.data, t.descripcio'
		)->from('ArxiuBundle:Documents', 't');
	
		$p='';
		if ($poblacio == "carlemany") $p = "Cartoral de Carlemany";
		elseif ($poblacio == "organya") $p = "Organya";
		elseif ($poblacio == "vilabertran") $p = "Vilabertran";
		elseif ($poblacio == "diplomatari") $p = "Diplomatari de Sant Feliu";
		elseif ($poblacio == "rubriques") $p = "Rubriques vermelles";
		elseif ($poblacio == "roses") $p = "Roses";
			
		$qb->where('t.poblacio = :poblacio');
		$qb->setParameter('poblacio', $p);
	
		$qb->andWhere('t.nodac LIKE :nodac');
		$qb->setParameter('nodac', '%'.$nodac.'%');
		
		$qb->andWhere('t.data LIKE :data');
		$qb->setParameter('data', '%'.$data.'%');
	
		$qb->andWhere('(t.texte LIKE :paraula OR t.descripcio LIKE :paraula OR t.referencia LIKE :paraula)');
		$qb->setParameter('paraula', '%'.$paraula.'%');
	
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	public function findDetalls($nodac){
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder();
		$qb->select('t.nodac, t.poblacio, t.data, t.descripcio, t.texte'
			)->from('ArxiuBundle:Documents', 't');
		
		$qb->orWhere('t.nodac = :nodac');
		$qb->setParameter('nodac', $nodac);
		$qb->setMaxResults(1);
		$q = $qb->getQuery();
		return $q->getResult();
	}
	
	
}