<?php

namespace ArtesanIO\ACLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuariosRoles
 *
 * @ORM\Table(name="acl_usuarios_roles")
 * @ORM\Entity
 */
class UsuariosRoles
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
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="roles")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="Roles", inversedBy="usuarios")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $roles;


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
     * Set usuarios
     *
     * @param string $usuarios
     * @return UsuariosRoles
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get usuarios
     *
     * @return string
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return UsuariosRoles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
