<?php

namespace ADG\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Noticies
 *
 * @ORM\Table(name="noticies")
 * @ORM\Entity
 */
class Noticies
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
     * @ORM\Column(name="data", type="text", nullable=true)
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
     * @ORM\Column(name="contingut", type="text", nullable=true)
     */
    private $contingut;



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
     * Set data
     *
     * @param string $data
     * @return Noticies
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
     * Set titol
     *
     * @param string $titol
     * @return Noticies
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
     * Set contingut
     *
     * @param string $contingut
     * @return Noticies
     */
    public function setContingut($contingut)
    {
        $this->contingut = $contingut;

        return $this;
    }

    /**
     * Get contingut
     *
     * @return string 
     */
    public function getContingut()
    {
        return $this->contingut;
    }
}
