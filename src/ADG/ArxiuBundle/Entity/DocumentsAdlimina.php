<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentsAdlimina
 *
 * @ORM\Table(name="documents_adlimina")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\DocumentsAdliminaRepository")
 */
class DocumentsAdlimina
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
     * @ORM\Column(name="poblacio", type="text", nullable=true)
     */
    private $poblacio;

    /**
     * @var string
     *
     * @ORM\Column(name="titol", type="text", nullable=true)
     */
    private $titol;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", nullable=true)
     */
    private $texte;



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
     * @return DocumentsAdlimina
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
     * Set poblacio
     *
     * @param string $poblacio
     * @return DocumentsAdlimina
     */
    public function setPoblacio($poblacio)
    {
        $this->poblacio = $poblacio;

        return $this;
    }

    /**
     * Get poblacio
     *
     * @return string 
     */
    public function getPoblacio()
    {
        return $this->poblacio;
    }

    /**
     * Set titol
     *
     * @param string $titol
     * @return DocumentsAdlimina
     */
    public function setTitol($titol)
    {
        $this->titol = $titol;

        return $this;
    }

    /**
     * Get titol
     *
     * @return string 
     */
    public function getTitol()
    {
        return $this->titol;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return DocumentsAdlimina
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }
}
