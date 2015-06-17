<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     */
    protected $password_hash;

    /**
     * @ORM\ManyToOne(targetEntity="Rol")
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id", nullable=false)
     */
    protected $rol;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_entidad_correspondiente;

    public function __toString()
    {
        return $this->getUsername();
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
     * @return Usuario
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
     * Set password_hash
     *
     * @param string $passwordHash
     * @return Usuario
     */
    public function setPasswordHash($passwordHash)
    {
        $this->password_hash = $passwordHash;

        return $this;
    }

    /**
     * Get password_hash
     *
     * @return string 
     */
    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    /**
     * Set id_entidad_correspondiente
     *
     * @param integer $idEntidadCorrespondiente
     * @return Usuario
     */
    public function setIdEntidadCorrespondiente($idEntidadCorrespondiente)
    {
        $this->id_entidad_correspondiente = $idEntidadCorrespondiente;

        return $this;
    }

    /**
     * Get id_entidad_correspondiente
     *
     * @return integer 
     */
    public function getIdEntidadCorrespondiente()
    {
        return $this->id_entidad_correspondiente;
    }

    /**
     * Set rol
     *
     * @param \Acme\boletinesBundle\Entity\Rol $rol
     * @return Usuario
     */
    public function setRol(\Acme\boletinesBundle\Entity\Rol $rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \Acme\boletinesBundle\Entity\Rol 
     */
    public function getRol()
    {
        return $this->rol;
    }
}
