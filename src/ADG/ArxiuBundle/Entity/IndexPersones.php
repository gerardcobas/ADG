<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndexPersones
 *
 * @ORM\Table(name="index_persones")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\IndexPersonesRepository")
 */
class IndexPersones
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     * @ORM\Id
     */
    private $nom;



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
     * @return IndexPersones
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
     * Set nom
     *
     * @param string $nom
     * @return IndexPersones
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set num
     *
     * @param string $num
     * @return IndexPersones
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }
}
