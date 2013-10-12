<?php

namespace ADG\PrincipalBundle\Entity;
use Doctrine\ORM\EntityRepository;

class NoticiesRepository extends EntityRepository
{
	public function findAll()
	{
		return $this->findBy(array(), array('data' => 'DESC'));
	}
}