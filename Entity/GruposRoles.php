<?php

namespace ArtesanIO\ACLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GruposRoles
 *
 * @ORM\Table(name="acl_grupos_roles")
 * @ORM\Entity
 */
class GruposRoles
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
     * @ORM\ManyToOne(targetEntity="Grupos", inversedBy="roles")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    private $grupos;

    /**
     * @ORM\ManyToOne(targetEntity="Roles", inversedBy="grupos")
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
     * Set grupos
     *
     * @param string $grupos
     * @return GruposRoles
     */
    public function setGrupos($grupos)
    {
        $this->grupos = $grupos;

        return $this;
    }

    /**
     * Get grupos
     *
     * @return string
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return GruposRoles
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
