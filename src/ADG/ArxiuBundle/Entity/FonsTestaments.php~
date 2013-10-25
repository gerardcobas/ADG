<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonsTestaments
 *
 * @ORM\Table(name="fons_testaments")
 * @ORM\Entity
 */
class FonsTestaments
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
     * @return FonsTestaments
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
     * @return FonsTestaments
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
}
