<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Establecimiento
 *
 * @ORM\Table(name="establecimiento", indexes={@ORM\Index(name="FK_94A4D17EEF433A34", columns={"institucion_id"}), @ORM\Index(name="fk_ciudad_establecimiento", columns={"ciudad_id"})})
 * @ORM\Entity
 */
class Establecimiento
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=45, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=12, nullable=true)
     */
    private $codigoPostal;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float", precision=10, scale=0, nullable=true)
     */
    private $longitud;

    /**
     * @var float
     *
     * @ORM\Column(name="latitud", type="float", precision=10, scale=0, nullable=true)
     */
    private $latitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inauguracion", type="date", nullable=true)
     */
    private $fechaInauguracion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_pais", type="string", length=4, nullable=true)
     */
    private $codigoPais;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_area", type="string", length=5, nullable=true)
     */
    private $codigoArea;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=12, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_faltas", type="integer", nullable=false)
     */
    private $maximoFaltas;

    /**
     * @var integer
     *
     * @ORM\Column(name="tardes_faltas", type="integer", nullable=false)
     */
    private $tardesFaltas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime", nullable=true)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Ciudad", inversedBy="establecimientos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     * })
     */
    private $ciudad;

    /**
     * @ORM\ManyToOne(targetEntity="Institucion", inversedBy="establecimientos")
     * @ORM\JoinColumn(name="institucion_id", referencedColumnName="id")
     */
    protected $institucion;

    /**
     * @ORM\ManyToOne(targetEntity="EsquemaCalificacion")
     * @ORM\JoinColumn(name="esquema_calificacion_id", referencedColumnName="id")
     */
    protected $esquemaCalificacion;

    /**
     * @var boolean
     */
    private $activo = true;

    private $materias;

    private $periodos;


    public function __construct()
    {
        $this->creationTime = new \DateTime();
        $this->materias = new ArrayCollection();
        $this->periodos = new ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Establecimiento
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
     * Set direccion
     *
     * @param string $direccion
     * @return Establecimiento
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set codigoPostal
     *
     * @param string $codigoPostal
     * @return Establecimiento
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     * @return Establecimiento
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return float
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set latitud
     *
     * @param float $latitud
     * @return Establecimiento
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return float
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set fechaInauguracion
     *
     * @param \DateTime $fechaInauguracion
     * @return Establecimiento
     */
    public function setFechaInauguracion($fechaInauguracion)
    {
        $this->fechaInauguracion = $fechaInauguracion;

        return $this;
    }

    /**
     * Get fechaInauguracion
     *
     * @return \DateTime
     */
    public function getFechaInauguracion()
    {
        return $this->fechaInauguracion;
    }

    /**
     * Set codigoPais
     *
     * @param string $codigoPais
     * @return Establecimiento
     */
    public function setCodigoPais($codigoPais)
    {
        $this->codigoPais = $codigoPais;

        return $this;
    }

    /**
     * Get codigoPais
     *
     * @return string
     */
    public function getCodigoPais()
    {
        return $this->codigoPais;
    }

    /**
     * Set codigoArea
     *
     * @param string $codigoArea
     * @return Establecimiento
     */
    public function setCodigoArea($codigoArea)
    {
        $this->codigoArea = $codigoArea;

        return $this;
    }

    /**
     * Get codigoArea
     *
     * @return string
     */
    public function getCodigoArea()
    {
        return $this->codigoArea;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Establecimiento
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Establecimiento
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Establecimiento
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set maximoFaltas
     *
     * @param integer $maximoFaltas
     * @return Establecimiento
     */
    public function setMaximoFaltas($maximoFaltas)
    {
        $this->maximoFaltas = $maximoFaltas;

        return $this;
    }

    /**
     * Get maximoFaltas
     *
     * @return integer
     */
    public function getMaximoFaltas()
    {
        return $this->maximoFaltas;
    }

    /**
     * Set tardesFaltas
     *
     * @param integer $tardesFaltas
     * @return Establecimiento
     */
    public function setTardesFaltas($tardesFaltas)
    {
        $this->tardesFaltas = $tardesFaltas;

        return $this;
    }

    /**
     * Get tardesFaltas
     *
     * @return integer
     */
    public function getTardesFaltas()
    {
        return $this->tardesFaltas;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Establecimiento
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return \DateTime
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Establecimiento
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
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
     * Set ciudad
     *
     * @param \Acme\boletinesBundle\Entity\Ciudad $ciudad
     * @return Establecimiento
     */
    public function setCiudad(\Acme\boletinesBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Acme\boletinesBundle\Entity\Ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set institucion
     *
     * @param \Acme\boletinesBundle\Entity\Institucion $institucion
     * @return Establecimiento
     */
    public function setInstitucion(\Acme\boletinesBundle\Entity\Institucion $institucion = null)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return \Acme\boletinesBundle\Entity\Institucion
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * @return \Acme\boletinesBundle\Entity\EsquemaCalificacion
     */
    public function getEsquemaCalificacion()
    {
        return $this->esquemaCalificacion;
    }

    /**
     * @param \Acme\boletinesBundle\Entity\EsquemaCalificacion $esquemaCalificacion
     */
    public function setEsquemaCalificacion($esquemaCalificacion)
    {
        $this->esquemaCalificacion = $esquemaCalificacion;
    }

    /**
     * @return boolean
     */
    public function isActivo()
    {
        return $this->activo;
    }

    /**
     * @param boolean $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }



    public function  __toString()
    {
        return $this->getNombre();
    }

    public function getMaterias()
    {
        return $this->materias;
    }

    public function getPeriodos()
    {
        return $this->periodos;
    }


}
