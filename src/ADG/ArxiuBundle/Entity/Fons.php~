<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fons
 *
 * @ORM\Table(name="fons")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\FonsRepository")
 */
class Fons
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

   

    /**
     * Get num
     *
     * @return string 
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set nodac
     *
     * @param string $nodac
     *
     * @return Fons
     */
    public function setNodac($nodac)
    {
        $this->nodac = $nodac;

        return $this;
    }

    /**
     * Get nodac
     *
     * @return string 
     */
    public function getNodac()
    {
        return $this->nodac;
    }

    /**
     * Set dades
     *
     * @param string $dades
     *
     * @return Fons
     */
    public function setDades($dades)
    {
        $this->dades = $dades;

        return $this;
    }

    /**
     * Get dades
     *
     * @return string 
     */
    public function getDades()
    {
        return $this->dades;
    }

    /**
     * Set llibre
     *
     * @param string $llibre
     *
     * @return Fons
     */
    public function setLlibre($llibre)
    {
        $this->llibre = $llibre;

        return $this;
    }

    /**
     * Get llibre
     *
     * @return string 
     */
    public function getLlibre()
    {
        return $this->llibre;
    }

    /**
     * Set full
     *
     * @param string $full
     *
     * @return Fons
     */
    public function setFull($full)
    {
        $this->full = $full;

        return $this;
    }

    /**
     * Get full
     *
     * @return string 
     */
    public function getFull()
    {
        return $this->full;
    }
}
