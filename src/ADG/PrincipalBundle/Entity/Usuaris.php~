<?php

namespace ADG\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * ADG\PrincipalBundle\Entity\Usuaris
 *
 * @ORM\Table(name="usuaris")
 * @ORM\Entity(repositoryClass="ADG\PrincipalBundle\Entity\UsuarisRepository")
 */
class Usuaris implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    
    /**
     * @ORM\Column(type="string", length=40)
     */
    private $roles;
    

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
	public function getRoles()
	{
		if (strcmp($this->roles, 'administrador') == 1) {
			return array('ROLE_ADMIN');
		}else{
			return array('ROLE_USER');
		}
	}

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }

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
     * Set username
     *
     * @param string $username
     * @return Usuaris
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuaris
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuaris
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuaris
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Usuaris
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return Usuaris
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
