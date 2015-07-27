<?php

namespace ArtesanIO\ACLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="acl_roles")
 * @ORM\Entity
 */
class Roles
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
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="role_key", type="string", length=255)
     */
    private $roleKey;

    /**
     * @ORM\OneToMany(targetEntity="UsuariosRoles", mappedBy="roles")
     */
    private $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="GruposRoles", mappedBy="roles")
     */
    private $grupos;

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
     * Set role
     *
     * @param string $role
     * @return Roles
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set roleKey
     *
     * @param string $roleKey
     * @return Roles
     */
    public function setRoleKey($roleKey)
    {
        $this->roleKey = $roleKey;

        return $this;
    }

    /**
     * Get roleKey
     *
     * @return string
     */
    public function getRoleKey()
    {
        return $this->roleKey;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usuarios
     *
     * @param \ArtesanIO\ACLBundle\Entity\UsuariosRoles $usuarios
     * @return Roles
     */
    public function addUsuario(\ArtesanIO\ACLBundle\Entity\UsuariosRoles $usuarios)
    {
        $this->usuarios[] = $usuarios;

        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \ArtesanIO\ACLBundle\Entity\UsuariosRoles $usuarios
     */
    public function removeUsuario(\ArtesanIO\ACLBundle\Entity\UsuariosRoles $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add grupos
     *
     * @param \ArtesanIO\ACLBundle\Entity\GruposRoles $grupos
     * @return Roles
     */
    public function addGrupo(\ArtesanIO\ACLBundle\Entity\GruposRoles $grupos)
    {
        $this->grupos[] = $grupos;

        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \ArtesanIO\ACLBundle\Entity\GruposRoles $grupos
     */
    public function removeGrupo(\ArtesanIO\ACLBundle\Entity\GruposRoles $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }
}
