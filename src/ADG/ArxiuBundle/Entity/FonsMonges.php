<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonsMonges
 *
 * @ORM\Table(name="fons_monges")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\FonsMongesRepository")
 */
class FonsMonges
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
     * @ORM\Column(name="cognom", type="text", nullable=true)
     */
    private $cognom;

    /**
     * @var string
     *
     * @ORM\Column(name="naturalDe", type="text", nullable=true)
     */
    private $naturalDe;

    /**
     * @var string
     *
     * @ORM\Column(name="congregacio", type="text", nullable=true)
     */
    private $congregacio;

    /**
     * @var string
     *
     * @ORM\Column(name="lloc_congregacio", type="text", nullable=true)
     */
    private $llocCongregacio;

    /**
     * @var string
     *
     * @ORM\Column(name="fitxa", type="text", nullable=true)
     */
    private $fitxa;



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
     * @return FonsMonges
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
     * @return FonsMonges
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
     * Set cognom
     *
     * @param string $cognom
     * @return FonsMonges
     */
    public function setCognom($cognom)
    {
        $this->cognom = $cognom;

        return $this;
    }

    /**
     * Get cognom
     *
     * @return string 
     */
    public function getCognom()
    {
        return $this->cognom;
    }

    /**
     * Set natural
     *
     * @param string $natural
     * @return FonsMonges
     */
    public function setNatural($natural)
    {
        $this->natural = $natural;

        return $this;
    }

    /**
     * Get natural
     *
     * @return string 
     */
    public function getNatural()
    {
        return $this->natural;
    }

    /**
     * Set congregacio
     *
     * @param string $congregacio
     * @return FonsMonges
     */
    public function setCongregacio($congregacio)
    {
        $this->congregacio = $congregacio;

        return $this;
    }

    /**
     * Get congregacio
     *
     * @return string 
     */
    public function getCongregacio()
    {
        return $this->congregacio;
    }

    /**
     * Set llocCongregacio
     *
     * @param string $llocCongregacio
     * @return FonsMonges
     */
    public function setLlocCongregacio($llocCongregacio)
    {
        $this->llocCongregacio = $llocCongregacio;

        return $this;
    }

    /**
     * Get llocCongregacio
     *
     * @return string 
     */
    public function getLlocCongregacio()
    {
        return $this->llocCongregacio;
    }

    /**
     * Set fitxa
     *
     * @param string $fitxa
     * @return FonsMonges
     */
    public function setFitxa($fitxa)
    {
        $this->fitxa = $fitxa;

        return $this;
    }

    /**
     * Get fitxa
     *
     * @return string 
     */
    public function getFitxa()
    {
        return $this->fitxa;
    }

    /**
     * Set num
     *
     * @param string $num
     *
     * @return FonsMonges
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Set naturalDe
     *
     * @param string $naturalDe
     *
     * @return FonsMonges
     */
    public function setNaturalDe($naturalDe)
    {
        $this->naturalDe = $naturalDe;

        return $this;
    }

    /**
     * Get naturalDe
     *
     * @return string 
     */
    public function getNaturalDe()
    {
        return $this->naturalDe;
    }
}
