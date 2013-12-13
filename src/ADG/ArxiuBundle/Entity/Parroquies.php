<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parroquies
 *
 * @ORM\Table(name="parroquies")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\ParroquiesRepository")
 */
class Parroquies
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
     * @ORM\Column(name="nom", type="text", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", length=255, nullable=true)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="titol", type="text", nullable=true)
     */
    private $titol;

    /**
     * @var string
     *
     * @ORM\Column(name="unitat", type="string", length=255, nullable=true)
     */
    private $unitat;

    /**
     * @var string
     *
     * @ORM\Column(name="volum", type="string", length=255, nullable=true)
     */
    private $volum;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mides", type="string", length=255, nullable=true)
     */
    private $mides;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cobertes", type="string", length=255, nullable=true)
     */
    private $cobertes;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pagines", type="string", length=255, nullable=true)
     */
    private $pagines;

    /**
     * @var string
     *
     * @ORM\Column(name="ambIndex", type="string", length=255, nullable=true)
     */
    private $ambIndex;
    
    /**
     * @var string
     *
     * @ORM\Column(name="acces", type="string", length=255, nullable=true)
     */
    private $acces;
    
    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", nullable=true)
     */
    private $notes;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estat", type="string", length=255, nullable=true)
     */
    private $estat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="llengua", type="string", length=255, nullable=true)
     */
    private $llengua;
    
    /**
     * @var string
     *
     * @ORM\Column(name="autors", type="string", length=255, nullable=true)
     */
    private $autors;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fitxa", type="string", length=255, nullable=true)
     */
    private $fitxa;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dataIngres", type="string", length=255, nullable=true)
     */
    private $dataIngres;
    

    
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
     * Set nom
     *
     * @param string $nom
     * @return Parroquies
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
     * Set imatge
     *
     * @param string $imatge
     * @return Parroquies
     */
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;

        return $this;
    }

    /**
     * Get imatge
     *
     * @return string 
     */
    public function getImatge()
    {
        return $this->imatge;
    }

    /**
     * Set descripcio
     *
     * @param string $descripcio
     * @return Parroquies
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    /**
     * Get descripcio
     *
     * @return string 
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * Set arxius
     *
     * @param string $arxius
     * @return Parroquies
     */
    public function setArxius($arxius)
    {
        $this->arxius = $arxius;

        return $this;
    }

    /**
     * Get arxius
     *
     * @return string 
     */
    public function getArxius()
    {
        return $this->arxius;
    }
}
