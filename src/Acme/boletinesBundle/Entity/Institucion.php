<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Institucion
 *
 * @ORM\Table(name="institucion")
 * @ORM\Entity
 */
class Institucion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_institucion", type="string", length=45, nullable=false)
     */
    private $nombreInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_institucion", type="string", length=45, nullable=false)
     */
    private $direccionInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_institucion", type="string", length=45, nullable=true)
     */
    private $telefonoInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="email_institucion", type="string", length=45, nullable=true)
     */
    private $emailInstitucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_institucion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInstitucion;

    /**
     * @param string $direccionInstitucion
     */
    public function setDireccionInstitucion($direccionInstitucion)
    {
        $this->direccionInstitucion = $direccionInstitucion;
    }

    /**
     * @return string
     */
    public function getDireccionInstitucion()
    {
        return $this->direccionInstitucion;
    }

    /**
     * @param string $emailInstitucion
     */
    public function setEmailInstitucion($emailInstitucion)
    {
        $this->emailInstitucion = $emailInstitucion;
    }

    /**
     * @return string
     */
    public function getEmailInstitucion()
    {
        return $this->emailInstitucion;
    }

    /**
     * @param int $idInstitucion
     */
    public function setIdInstitucion($idInstitucion)
    {
        $this->idInstitucion = $idInstitucion;
    }

    /**
     * @return int
     */
    public function getIdInstitucion()
    {
        return $this->idInstitucion;
    }

    /**
     * @param string $nombreInstitucion
     */
    public function setNombreInstitucion($nombreInstitucion)
    {
        $this->nombreInstitucion = $nombreInstitucion;
    }

    /**
     * @return string
     */
    public function getNombreInstitucion()
    {
        return $this->nombreInstitucion;
    }

    /**
     * @param string $telefonoInstitucion
     */
    public function setTelefonoInstitucion($telefonoInstitucion)
    {
        $this->telefonoInstitucion = $telefonoInstitucion;
    }

    /**
     * @return string
     */
    public function getTelefonoInstitucion()
    {
        return $this->telefonoInstitucion;
    }

    public function _toString()
    {
        return $this->getNombreInstitucion();
    }


}
