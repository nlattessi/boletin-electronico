<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Establecimiento
 *
 * @ORM\Table(name="establecimiento", indexes={@ORM\Index(name="institucion_fk_establecimiento", columns={"id_institucion"})})
 * @ORM\Entity
 */
class Establecimiento
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_establecimiento", type="string", length=45, nullable=false)
     */
    private $nombreEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_establecimiento", type="string", length=45, nullable=true)
     */
    private $direccionEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_establecimiento", type="string", length=45, nullable=true)
     */
    private $telefonoEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="email_establecimiento", type="string", length=45, nullable=true)
     */
    private $emailEstablecimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_establecimiento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstablecimiento;

    /**
     * @var \Acme\boletinesBundle\Entity\Institucion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Institucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_institucion", referencedColumnName="id_institucion")
     * })
     */
    private $idInstitucion;

    /**
     * @return string
     */
    public function getNombreEstablecimiento()
    {
        return $this->nombreEstablecimiento;
    }

    /**
     * @param string $nombreEstablecimiento
     */
    public function setNombreEstablecimiento($nombreEstablecimiento)
    {
        $this->nombreEstablecimiento = $nombreEstablecimiento;
    }

    /**
     * @return string
     */
    public function getDireccionEstablecimiento()
    {
        return $this->direccionEstablecimiento;
    }

    /**
     * @param string $direccionEstablecimiento
     */
    public function setDireccionEstablecimiento($direccionEstablecimiento)
    {
        $this->direccionEstablecimiento = $direccionEstablecimiento;
    }

    /**
     * @return string
     */
    public function getTelefonoEstablecimiento()
    {
        return $this->telefonoEstablecimiento;
    }

    /**
     * @param string $telefonoEstablecimiento
     */
    public function setTelefonoEstablecimiento($telefonoEstablecimiento)
    {
        $this->telefonoEstablecimiento = $telefonoEstablecimiento;
    }

    /**
     * @return string
     */
    public function getEmailEstablecimiento()
    {
        return $this->emailEstablecimiento;
    }

    /**
     * @param string $emailEstablecimiento
     */
    public function setEmailEstablecimiento($emailEstablecimiento)
    {
        $this->emailEstablecimiento = $emailEstablecimiento;
    }

    /**
     * @return int
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * @param int $idEstablecimiento
     */
    public function setIdEstablecimiento($idEstablecimiento)
    {
        $this->idEstablecimiento = $idEstablecimiento;
    }

    /**
     * @return Institucion
     */
    public function getIdInstitucion()
    {
        return $this->idInstitucion;
    }

    /**
     * @param Institucion $idInstitucion
     */
    public function setIdInstitucion($idInstitucion)
    {
        $this->idInstitucion = $idInstitucion;
    }


    public function __toString(){
        return $this->getNombreEstablecimiento();
    }
}
