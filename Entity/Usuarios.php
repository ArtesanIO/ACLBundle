<?php

namespace ArtesanIO\ACLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuarios
 *
 * @ORM\Table(name="acl_usuarios")
 * @ORM\Entity(repositoryClass="ArtesanIO\ACLBundle\Entity\UsuariosRepository")
 * @UniqueEntity(fields={"email"}, message="Este email ya está en uso. No lo puedes usar")
 */
class Usuarios implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank(message="El nombre es obligatorio")
     */
    private $nombre;

    /**
    * @ORM\Column(type="string", length=255, unique=true)
    * @Assert\NotBlank(message="El Username es obligatorio")
    */
    private $username;

    /**
    * @ORM\Column(type="string", length=32)
    */
    private $salt;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank(message="La Contraseña no debe quedar vacía")
    */
    private $password;

    /**
    * @ORM\Column(type="string", length=255, unique=true)
    * @Assert\NotBlank(message="La Email no debe quedar vacío")
    * @Assert\Email(message="{{ value }} no es un email válido")
    */
    private $email;

    /**
    * @ORM\Column(name="is_active", type="boolean")
    */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="Grupos", inversedBy="usuarios")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */

    private $grupos;

    /**
     * @ORM\OneToMany(targetEntity="UsuariosRoles", mappedBy="usuarios")
     */
    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuarios
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Usuarios
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuarios
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuarios
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
     * @return Usuarios
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
     * Set grupos
     *
     * @param \ArtesanIO\ACLBundle\Entity\Grupos $grupos
     * @return Usuarios
     */
    public function setGrupos(\ArtesanIO\ACLBundle\Entity\Grupos $grupos = null)
    {
        $this->grupos = $grupos;

        return $this;
    }

    /**
     * Get grupos
     *
     * @return \ArtesanIO\ACLBundle\Entity\Grupos
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Add roles
     *
     * @param \ArtesanIO\ACLBundle\Entity\UsuariosRoles $roles
     * @return Usuarios
     */
    public function addRole(\ArtesanIO\ACLBundle\Entity\UsuariosRoles $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \ArtesanIO\ACLBundle\Entity\UsuariosRoles $roles
     */
    public function removeRole(\ArtesanIO\ACLBundle\Entity\UsuariosRoles $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
}
