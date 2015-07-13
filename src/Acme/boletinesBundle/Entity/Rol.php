<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity
 */
class Rol
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_rol", type="string", length=45, nullable=false)
     */
    private $nombreRol;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_rol", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRol;

    /**
     * @return string
     */
    public function getNombreRol()
    {
        return $this->nombreRol;
    }

    public function __toString(){
        return $this->getNombreRol();
    }

    public function getId(){
        return $this->idRol;
    }

    /**
     * @return int
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Set nombreRol
     *
     * @param string $nombreRol
     * @return Rol
     */
    public function setNombreRol($nombreRol)
    {
        $this->nombreRol = $nombreRol;

        return $this;
    }
}
