<?php

namespace ADG\ArxiuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuiaUcomposta
 *
 * @ORM\Table(name="guia_ucomposta")
 * @ORM\Entity(repositoryClass="ADG\ArxiuBundle\Entity\GuiaUcompostaRepository")
 */
class GuiaUcomposta
{
    /**
     * @var string
     *
     * @ORM\Column(name="nivell", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nivell;

    /**
     * @var string
     *
     * @ORM\Column(name="codi", type="text", nullable=true)
     */
    private $codi;

    /**
     * @var string
     *
     * @ORM\Column(name="titol", type="text", nullable=true)
     */
    private $titol;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=true)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="volum", type="text", nullable=true)
     */
    private $volum;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_productor", type="text", nullable=true)
     */
    private $nomProductor;

    /**
     * @var string
     *
     * @ORM\Column(name="historia_productor", type="text", nullable=true)
     */
    private $historiaProductor;

    /**
     * @var string
     *
     * @ORM\Column(name="historia_arxivistica", type="text", nullable=true)
     */
    private $historiaArxivistica;

    /**
     * @var string
     *
     * @ORM\Column(name="dades_ingres", type="text", nullable=true)
     */
    private $dadesIngres;

    /**
     * @var string
     *
     * @ORM\Column(name="abast", type="text", nullable=true)
     */
    private $abast;

    /**
     * @var string
     *
     * @ORM\Column(name="organitzacio", type="text", nullable=true)
     */
    private $organitzacio;

    /**
     * @var string
     *
     * @ORM\Column(name="informacio_utilitzacio", type="text", nullable=true)
     */
    private $informacioUtilitzacio;

    /**
     * @var string
     *
     * @ORM\Column(name="increments", type="text", nullable=true)
     */
    private $increments;

    /**
     * @var string
     *
     * @ORM\Column(name="condicions_acces", type="text", nullable=true)
     */
    private $condicionsAcces;

    /**
     * @var string
     *
     * @ORM\Column(name="condicions_reproduccio", type="text", nullable=true)
     */
    private $condicionsReproduccio;

    /**
     * @var string
     *
     * @ORM\Column(name="llengues", type="text", nullable=true)
     */
    private $llengues;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristiques", type="text", nullable=true)
     */
    private $caracteristiques;

    /**
     * @var string
     *
     * @ORM\Column(name="instruments", type="text", nullable=true)
     */
    private $instruments;

    /**
     * @var string
     *
     * @ORM\Column(name="existencia_originals", type="text", nullable=true)
     */
    private $existenciaOriginals;

    /**
     * @var string
     *
     * @ORM\Column(name="existencia_reproduccions", type="text", nullable=true)
     */
    private $existenciaReproduccions;

    /**
     * @var string
     *
     * @ORM\Column(name="documentacio", type="text", nullable=true)
     */
    private $documentacio;

    /**
     * @var string
     *
     * @ORM\Column(name="bibliografia", type="text", nullable=true)
     */
    private $bibliografia;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="autoria", type="text", nullable=true)
     */
    private $autoria;

    /**
     * @var string
     *
     * @ORM\Column(name="fonts", type="text", nullable=true)
     */
    private $fonts;

    /**
     * @var string
     *
     * @ORM\Column(name="regles", type="text", nullable=true)
     */
    private $regles;



    /**
     * Get nivell
     *
     * @return string 
     */
    public function getNivell()
    {
        return $this->nivell;
    }

    /**
     * Set codi
     *
     * @param string $codi
     * @return GuiaUcomposta
     */
    public function setCodi($codi)
    {
        $this->codi = $codi;

        return $this;
    }

    /**
     * Get codi
     *
     * @return string 
     */
    public function getCodi()
    {
        return $this->codi;
    }

    /**
     * Set titol
     *
     * @param string $titol
     * @return GuiaUcomposta
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
     * Set data
     *
     * @param string $data
     * @return GuiaUcomposta
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
     * Set volum
     *
     * @param string $volum
     * @return GuiaUcomposta
     */
    public function setVolum($volum)
    {
        $this->volum = $volum;

        return $this;
    }

    /**
     * Get volum
     *
     * @return string 
     */
    public function getVolum()
    {
        return $this->volum;
    }

    /**
     * Set nomProductor
     *
     * @param string $nomProductor
     * @return GuiaUcomposta
     */
    public function setNomProductor($nomProductor)
    {
        $this->nomProductor = $nomProductor;

        return $this;
    }

    /**
     * Get nomProductor
     *
     * @return string 
     */
    public function getNomProductor()
    {
        return $this->nomProductor;
    }

    /**
     * Set historiaProductor
     *
     * @param string $historiaProductor
     * @return GuiaUcomposta
     */
    public function setHistoriaProductor($historiaProductor)
    {
        $this->historiaProductor = $historiaProductor;

        return $this;
    }

    /**
     * Get historiaProductor
     *
     * @return string 
     */
    public function getHistoriaProductor()
    {
        return $this->historiaProductor;
    }

    /**
     * Set historiaArxivistica
     *
     * @param string $historiaArxivistica
     * @return GuiaUcomposta
     */
    public function setHistoriaArxivistica($historiaArxivistica)
    {
        $this->historiaArxivistica = $historiaArxivistica;

        return $this;
    }

    /**
     * Get historiaArxivistica
     *
     * @return string 
     */
    public function getHistoriaArxivistica()
    {
        return $this->historiaArxivistica;
    }

    /**
     * Set dadesIngres
     *
     * @param string $dadesIngres
     * @return GuiaUcomposta
     */
    public function setDadesIngres($dadesIngres)
    {
        $this->dadesIngres = $dadesIngres;

        return $this;
    }

    /**
     * Get dadesIngres
     *
     * @return string 
     */
    public function getDadesIngres()
    {
        return $this->dadesIngres;
    }

    /**
     * Set abast
     *
     * @param string $abast
     * @return GuiaUcomposta
     */
    public function setAbast($abast)
    {
        $this->abast = $abast;

        return $this;
    }

    /**
     * Get abast
     *
     * @return string 
     */
    public function getAbast()
    {
        return $this->abast;
    }

    /**
     * Set organitzacio
     *
     * @param string $organitzacio
     * @return GuiaUcomposta
     */
    public function setOrganitzacio($organitzacio)
    {
        $this->organitzacio = $organitzacio;

        return $this;
    }

    /**
     * Get organitzacio
     *
     * @return string 
     */
    public function getOrganitzacio()
    {
        return $this->organitzacio;
    }

    /**
     * Set informacioUtilitzacio
     *
     * @param string $informacioUtilitzacio
     * @return GuiaUcomposta
     */
    public function setInformacioUtilitzacio($informacioUtilitzacio)
    {
        $this->informacioUtilitzacio = $informacioUtilitzacio;

        return $this;
    }

    /**
     * Get informacioUtilitzacio
     *
     * @return string 
     */
    public function getInformacioUtilitzacio()
    {
        return $this->informacioUtilitzacio;
    }

    /**
     * Set increments
     *
     * @param string $increments
     * @return GuiaUcomposta
     */
    public function setIncrements($increments)
    {
        $this->increments = $increments;

        return $this;
    }

    /**
     * Get increments
     *
     * @return string 
     */
    public function getIncrements()
    {
        return $this->increments;
    }

    /**
     * Set condicionsAcces
     *
     * @param string $condicionsAcces
     * @return GuiaUcomposta
     */
    public function setCondicionsAcces($condicionsAcces)
    {
        $this->condicionsAcces = $condicionsAcces;

        return $this;
    }

    /**
     * Get condicionsAcces
     *
     * @return string 
     */
    public function getCondicionsAcces()
    {
        return $this->condicionsAcces;
    }

    /**
     * Set condicionsReproduccio
     *
     * @param string $condicionsReproduccio
     * @return GuiaUcomposta
     */
    public function setCondicionsReproduccio($condicionsReproduccio)
    {
        $this->condicionsReproduccio = $condicionsReproduccio;

        return $this;
    }

    /**
     * Get condicionsReproduccio
     *
     * @return string 
     */
    public function getCondicionsReproduccio()
    {
        return $this->condicionsReproduccio;
    }

    /**
     * Set llengues
     *
     * @param string $llengues
     * @return GuiaUcomposta
     */
    public function setLlengues($llengues)
    {
        $this->llengues = $llengues;

        return $this;
    }

    /**
     * Get llengues
     *
     * @return string 
     */
    public function getLlengues()
    {
        return $this->llengues;
    }

    /**
     * Set caracteristiques
     *
     * @param string $caracteristiques
     * @return GuiaUcomposta
     */
    public function setCaracteristiques($caracteristiques)
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    /**
     * Get caracteristiques
     *
     * @return string 
     */
    public function getCaracteristiques()
    {
        return $this->caracteristiques;
    }

    /**
     * Set instruments
     *
     * @param string $instruments
     * @return GuiaUcomposta
     */
    public function setInstruments($instruments)
    {
        $this->instruments = $instruments;

        return $this;
    }

    /**
     * Get instruments
     *
     * @return string 
     */
    public function getInstruments()
    {
        return $this->instruments;
    }

    /**
     * Set existenciaOriginals
     *
     * @param string $existenciaOriginals
     * @return GuiaUcomposta
     */
    public function setExistenciaOriginals($existenciaOriginals)
    {
        $this->existenciaOriginals = $existenciaOriginals;

        return $this;
    }

    /**
     * Get existenciaOriginals
     *
     * @return string 
     */
    public function getExistenciaOriginals()
    {
        return $this->existenciaOriginals;
    }

    /**
     * Set existenciaReproduccions
     *
     * @param string $existenciaReproduccions
     * @return GuiaUcomposta
     */
    public function setExistenciaReproduccions($existenciaReproduccions)
    {
        $this->existenciaReproduccions = $existenciaReproduccions;

        return $this;
    }

    /**
     * Get existenciaReproduccions
     *
     * @return string 
     */
    public function getExistenciaReproduccions()
    {
        return $this->existenciaReproduccions;
    }

    /**
     * Set documentacio
     *
     * @param string $documentacio
     * @return GuiaUcomposta
     */
    public function setDocumentacio($documentacio)
    {
        $this->documentacio = $documentacio;

        return $this;
    }

    /**
     * Get documentacio
     *
     * @return string 
     */
    public function getDocumentacio()
    {
        return $this->documentacio;
    }

    /**
     * Set bibliografia
     *
     * @param string $bibliografia
     * @return GuiaUcomposta
     */
    public function setBibliografia($bibliografia)
    {
        $this->bibliografia = $bibliografia;

        return $this;
    }

    /**
     * Get bibliografia
     *
     * @return string 
     */
    public function getBibliografia()
    {
        return $this->bibliografia;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return GuiaUcomposta
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set autoria
     *
     * @param string $autoria
     * @return GuiaUcomposta
     */
    public function setAutoria($autoria)
    {
        $this->autoria = $autoria;

        return $this;
    }

    /**
     * Get autoria
     *
     * @return string 
     */
    public function getAutoria()
    {
        return $this->autoria;
    }

    /**
     * Set fonts
     *
     * @param string $fonts
     * @return GuiaUcomposta
     */
    public function setFonts($fonts)
    {
        $this->fonts = $fonts;

        return $this;
    }

    /**
     * Get fonts
     *
     * @return string 
     */
    public function getFonts()
    {
        return $this->fonts;
    }

    /**
     * Set regles
     *
     * @param string $regles
     * @return GuiaUcomposta
     */
    public function setRegles($regles)
    {
        $this->regles = $regles;

        return $this;
    }

    /**
     * Get regles
     *
     * @return string 
     */
    public function getRegles()
    {
        return $this->regles;
    }
}
