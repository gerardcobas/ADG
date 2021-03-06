<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonsMitra
 *
 * @ORM\Table(name="fons_mitra")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\FonsMitraRepository")
 */
class FonsMitra
{
    /**
     * @var string
     *
     * @ORM\Column(name="num", type="string", length=255, nullable=false)
     * @ORM\Id
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
     * @return FonsMitra
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
     * @return FonsMitra
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
     * @return FonsMitra
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
     * @return FonsMitra
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
     * @return FonsMitra
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
     * @return FonsMitra
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

    /**
     * Set num
     *
     * @param string $num
     *
     * @return FonsMitra
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }
}
