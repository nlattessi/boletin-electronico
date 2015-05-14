<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actividad
 *
 * @ORM\Table(name="actividad", indexes={@ORM\Index(name="usuario_fk_actividad", columns={"id_usuario_creador"}), @ORM\Index(name="archivo_fk_actividad", columns={"id_archivo"})})
 * @ORM\Entity
 */
class Actividad
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_actividad", type="string", length=45, nullable=false)
     */
    private $nombreActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_actividad", type="string", length=500, nullable=false)
     */
    private $descripcionActividad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_desde", type="datetime", nullable=false)
     */
    private $fechaDesde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hasta", type="datetime", nullable=false)
     */
    private $fechaHasta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_actividad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActividad;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_creador", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioCreador;

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
     * @return string
     */
    public function getNombreActividad()
    {
        return $this->nombreActividad;
    }

    /**
     * @param string $nombreActividad
     */
    public function setNombreActividad($nombreActividad)
    {
        $this->nombreActividad = $nombreActividad;
    }

    /**
     * @return string
     */
    public function getDescripcionActividad()
    {
        return $this->descripcionActividad;
    }

    /**
     * @param string $descripcionActividad
     */
    public function setDescripcionActividad($descripcionActividad)
    {
        $this->descripcionActividad = $descripcionActividad;
    }

    /**
     * @return \DateTime
     */
    public function getFechaDesde()
    {
        return $this->fechaDesde;
    }

    /**
     * @param \DateTime $fechaDesde
     */
    public function setFechaDesde($fechaDesde)
    {
        $this->fechaDesde = $fechaDesde;
    }

    /**
     * @return \DateTime
     */
    public function getFechaHasta()
    {
        return $this->fechaHasta;
    }

    /**
     * @param \DateTime $fechaHasta
     */
    public function setFechaHasta($fechaHasta)
    {
        $this->fechaHasta = $fechaHasta;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param \DateTime $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return int
     */
    public function getIdActividad()
    {
        return $this->idActividad;
    }

    /**
     * @param int $idActividad
     */
    public function setIdActividad($idActividad)
    {
        $this->idActividad = $idActividad;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioCreador()
    {
        return $this->idUsuarioCreador;
    }

    /**
     * @param Usuario $idUsuarioCreador
     */
    public function setUsuarioCreador($idUsuarioCreador)
    {
        $this->idUsuarioCreador = $idUsuarioCreador;
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

        return $this->getNombreActividad();
    }

}
