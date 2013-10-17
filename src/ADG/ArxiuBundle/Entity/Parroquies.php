<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parroquies
 *
 * @ORM\Table(name="parroquies")
 * @ORM\Entity
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
     * @ORM\Column(name="nom", type="text", nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="imatge", type="string", length=255, nullable=true)
     */
    private $imatge;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcio", type="text", nullable=true)
     */
    private $descripcio;

    /**
     * @var string
     *
     * @ORM\Column(name="arxius", type="string", length=45, nullable=true)
     */
    private $arxius;



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