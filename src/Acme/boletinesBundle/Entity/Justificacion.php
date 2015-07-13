<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Justificacion
 *
 * @ORM\Table(name="justificacion", indexes={@ORM\Index(name="usuario_fk_justificacion", columns={"id_usuario_carga"}), @ORM\Index(name="archivo_fk_justificacion", columns={"id_archivo"})})
 * @ORM\Entity
 */
class Justificacion
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carga", type="datetime", nullable=false)
     */
    private $fechaCarga;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=255, nullable=false)
     */
    private $justificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_justificacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJustificacion;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_carga", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioCarga;

    /**
     * @var \Acme\boletinesBundle\Entity\Archivo
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_archivo", referencedColumnName="id_archivo")
     * })
     */
    private $idArchivo;

    /**
     * @return \DateTime
     */
    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }

    /**
     * @param \DateTime $fechaCarga
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;
    }

    /**
     * @return string
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * @param string $justificacion
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;
    }

    /**
     * @return int
     */
    public function getIdJustificacion()
    {
        return $this->idJustificacion;
    }

    /**
     * @param int $idJustificacion
     */
    public function setIdJustificacion($idJustificacion)
    {
        $this->idJustificacion = $idJustificacion;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioCarga()
    {
        return $this->idUsuarioCarga;
    }

    /**
     * @param Usuario $idUsuarioCarga
     */
    public function setUsuarioCarga($idUsuarioCarga)
    {
        $this->idUsuarioCarga = $idUsuarioCarga;
    }

    /**
     * @return Archivo
     */
    public function getArchivo()
    {
        return $this->idArchivo;
    }

    /**
     * @param Archivo $idArchivo
     */
    public function setArchivo($idArchivo)
    {
        $this->idArchivo = $idArchivo;
    }

    public function __toString(){
        return $this->getJustificacion();
    }

    /**
     * Set idUsuarioCarga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioCarga
     * @return Justificacion
     */
    public function setIdUsuarioCarga(\Acme\boletinesBundle\Entity\Usuario $idUsuarioCarga = null)
    {
        $this->idUsuarioCarga = $idUsuarioCarga;

        return $this;
    }

    /**
     * Get idUsuarioCarga
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getIdUsuarioCarga()
    {
        return $this->idUsuarioCarga;
    }

    /**
     * Set idArchivo
     *
     * @param \Acme\boletinesBundle\Entity\Archivo $idArchivo
     * @return Justificacion
     */
    public function setIdArchivo(\Acme\boletinesBundle\Entity\Archivo $idArchivo = null)
    {
        $this->idArchivo = $idArchivo;

        return $this;
    }

    /**
     * Get idArchivo
     *
     * @return \Acme\boletinesBundle\Entity\Archivo 
     */
    public function getIdArchivo()
    {
        return $this->idArchivo;
    }
}
