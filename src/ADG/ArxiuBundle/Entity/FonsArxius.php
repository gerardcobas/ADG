<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonsArxius
 *
 * @ORM\Table(name="fons_arxius")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\FonsArxiusRepository")
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
     * @ORM\Column(name="data", type="text", nullable=true)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="dades", type="text", nullable=true)
     */
    private $dades;

    /**
     * @var string
     *
     * @ORM\Column(name="notari", type="text", nullable=true)
     */
    private $notari;

    /**
     * @var string
     *
     * @ORM\Column(name="mides", type="text", nullable=true)
     */
    private $mides;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", nullable=true)
     */
    private $obs;



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
     * @return FonsArxius
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
     * Set data
     *
     * @param string $data
     * @return FonsArxius
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set dades
     *
     * @param string $dades
     * @return FonsArxius
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
     * Set notari
     *
     * @param string $notari
     * @return FonsArxius
     */
    public function setNotari($notari)
    {
        $this->notari = $notari;

        return $this;
    }

    /**
     * Get notari
     *
     * @return string 
     */
    public function getNotari()
    {
        return $this->notari;
    }

    /**
     * Set mides
     *
     * @param string $mides
     * @return FonsArxius
     */
    public function setMides($mides)
    {
        $this->mides = $mides;

        return $this;
    }

    /**
     * Get mides
     *
     * @return string 
     */
    public function getMides()
    {
        return $this->mides;
    }

    /**
     * Set obs
     *
     * @param string $obs
     * @return FonsArxius
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }

    /**
     * Get obs
     *
     * @return string 
     */
    public function getObs()
    {
        return $this->obs;
    }
}
