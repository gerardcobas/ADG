<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonsArxius
 *
 * @ORM\Table(name="fons")
 * @ORM\Entity
 */
class FonsArxius
{
    /**
     * @var string
     *
     * @ORM\Column(name="num", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $num;

    /**
     * @var string
     *
     * @ORM\Column(name="nodac", type="string", length=255, nullable=true)
     */
    private $nodac;

    /**
     * @var string
     *
     * @ORM\Column(name="dades", type="text", nullable=true)
     */
    private $dades;

    /**
     * @var string
     *
     * @ORM\Column(name="llibre", type="text", nullable=true)
     */
    private $llibre;

    /**
     * @var string
     *
     * @ORM\Column(name="full", type="text", nullable=true)
     */
    private $full;

   
}
