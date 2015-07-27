<?php

namespace ArtesanIO\ACLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grupos
 *
 * @ORM\Table(name="acl_grupos")
 * @ORM\Entity
 */
class Grupos
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
     * @ORM\Column(name="grupo", type="string", length=255)
     */
    private $grupo;

    /**
     * @ORM\OneToMany(targetEntity="Usuarios", mappedBy="grupos")
     */

    private $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="GruposRoles", mappedBy="grupos", cascade={"persist"})
     */

    private $roles;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set grupo
     *
     * @param string $grupo
     * @return Grupos
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Add usuarios
     *
     * @param \ArtesanIO\ACLBundle\Entity\Usuarios $usuarios
     * @return Grupos
     */
    public function addUsuario(\ArtesanIO\ACLBundle\Entity\Usuarios $usuarios)
    {
        $this->usuarios[] = $usuarios;

        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \ArtesanIO\ACLBundle\Entity\Usuarios $usuarios
     */
    public function removeUsuario(\ArtesanIO\ACLBundle\Entity\Usuarios $usuarios)
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
     * Add roles
     *
     * @param \ArtesanIO\ACLBundle\Entity\GruposRoles $roles
     * @return Grupos
     */
    public function addRole(\ArtesanIO\ACLBundle\Entity\GruposRoles $roles)
    {
        $roles->setGrupos($this);
        $this->roles->add($roles);
    }

    /**
     * Remove roles
     *
     * @param \ArtesanIO\ACLBundle\Entity\GruposRoles $roles
     */
    public function removeRole(\ArtesanIO\ACLBundle\Entity\GruposRoles $roles)
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
}
