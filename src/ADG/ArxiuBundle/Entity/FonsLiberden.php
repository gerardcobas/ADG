<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonsLiberden
 *
 * @ORM\Table(name="fons_liberden")
 * @ORM\Entity
 */
class FonsLiberden
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nodac", type="string", length=255, nullable=true)
     */
    private $nodac;

    /**
     * @var string
     *
     * @ORM\Column(name="institucio", type="text", nullable=true)
     */
    private $institucio;

    /**
     * @var string
     *
     * @ORM\Column(name="foli", type="text", nullable=true)
     */
    private $foli;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nodac
     *
     * @param string $nodac
     * @return FonsLiberden
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
     * Set institucio
     *
     * @param string $institucio
     * @return FonsLiberden
     */
    public function setInstitucio($institucio)
    {
        $this->institucio = $institucio;

        return $this;
    }

    /**
     * Get institucio
     *
     * @return string 
     */
    public function getInstitucio()
    {
        return $this->institucio;
    }

    /**
     * Set foli
     *
     * @param string $foli
     * @return FonsLiberden
     */
    public function setFoli($foli)
    {
        $this->foli = $foli;

        return $this;
    }

    /**
     * Get foli
     *
     * @return string 
     */
    public function getFoli()
    {
        return $this->foli;
    }
}
