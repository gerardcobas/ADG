<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndexLlocs
 *
 * @ORM\Table(name="index_llocs")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\IndexLlocsRepository")
 */
class IndexLlocs
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
     * @ORM\Column(name="nom", type="text", nullable=true)
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
     * @return IndexLlocs
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
     * @return IndexLlocs
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
     * @return IndexLlocs
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }
}
