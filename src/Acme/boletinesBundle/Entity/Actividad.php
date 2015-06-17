<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="actividad")
 */
class Actividad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descripcion;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_desde;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_hasta;

    /**
     * @ORM\ManyToOne(targetEntity="Archivo")
     * @ORM\JoinColumn(name="archivo_id", referencedColumnName="id", nullable=true)
     */
    protected $archivo;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_carga_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario_carga;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_carga;

    public function __construct()
    {
        $this->fecha_carga = new \DateTime();
    }

    public function __toString()
    {
        return $this->getNombre();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Actividad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Actividad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha_desde
     *
     * @param \DateTime $fechaDesde
     * @return Actividad
     */
    public function setFechaDesde($fechaDesde)
    {
        $this->fecha_desde = $fechaDesde;

        return $this;
    }

    /**
     * Get fecha_desde
     *
     * @return \DateTime 
     */
    public function getFechaDesde()
    {
        return $this->fecha_desde;
    }

    /**
     * Set fecha_hasta
     *
     * @param \DateTime $fechaHasta
     * @return Actividad
     */
    public function setFechaHasta($fechaHasta)
    {
        $this->fecha_hasta = $fechaHasta;

        return $this;
    }

    /**
     * Get fecha_hasta
     *
     * @return \DateTime 
     */
    public function getFechaHasta()
    {
        return $this->fecha_hasta;
    }

    /**
     * Set fecha_carga
     *
     * @param \DateTime $fechaCarga
     * @return Actividad
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fecha_carga = $fechaCarga;

        return $this;
    }

    /**
     * Get fecha_carga
     *
     * @return \DateTime 
     */
    public function getFechaCarga()
    {
        return $this->fecha_carga;
    }

    /**
     * Set archivo
     *
     * @param \Acme\boletinesBundle\Entity\Archivo $archivo
     * @return Actividad
     */
    public function setArchivo(\Acme\boletinesBundle\Entity\Archivo $archivo = null)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return \Acme\boletinesBundle\Entity\Archivo 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set usuario_carga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Actividad
     */
    public function setUsuarioCarga(\Acme\boletinesBundle\Entity\Usuario $usuarioCarga)
    {
        $this->usuario_carga = $usuarioCarga;

        return $this;
    }

    /**
     * Get usuario_carga
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuarioCarga()
    {
        return $this->usuario_carga;
    }
}
