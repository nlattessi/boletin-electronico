<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendario
 *
 * @ORM\Table(name="calendario", indexes={@ORM\Index(name="usuario_fk_calendario", columns={"id_usuario_propietario"})})
 * @ORM\Entity
 */
class Calendario
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_calendario", type="string", length=45, nullable=false)
     */
    private $nombreCalendario;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_calendario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCalendario;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_propietario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioPropietario;



    /**
     * Set nombreCalendario
     *
     * @param string $nombreCalendario
     * @return Calendario
     */
    public function setNombreCalendario($nombreCalendario)
    {
        $this->nombreCalendario = $nombreCalendario;

        return $this;
    }

    /**
     * Get nombreCalendario
     *
     * @return string 
     */
    public function getNombreCalendario()
    {
        return $this->nombreCalendario;
    }

    /**
     * Get idCalendario
     *
     * @return integer 
     */
    public function getIdCalendario()
    {
        return $this->idCalendario;
    }

    /**
     * Set idUsuarioPropietario
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioPropietario
     * @return Calendario
     */
    public function setIdUsuarioPropietario(\Acme\boletinesBundle\Entity\Usuario $idUsuarioPropietario = null)
    {
        $this->idUsuarioPropietario = $idUsuarioPropietario;

        return $this;
    }

    /**
     * Get idUsuarioPropietario
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getIdUsuarioPropietario()
    {
        return $this->idUsuarioPropietario;
    }
}
