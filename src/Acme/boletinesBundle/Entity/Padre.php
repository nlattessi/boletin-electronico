<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Padre
 *
 * @ORM\Table(name="padre", indexes={@ORM\Index(name="FK_usuario_padre", columns={"usuario_id"}), @ORM\Index(name="fk_ciudad_padre", columns={"ciudad_id"})})
 * @ORM\Entity
 */
class Padre
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=25, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=8, nullable=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=45, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_laboral", type="string", length=45, nullable=true)
     */
    private $direccionLaboral;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=45, nullable=true)
     */
    private $codigoPostal;

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
     * @ORM\Column(name="telefono", type="string", length=12, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=12, nullable=false)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_laboral", type="string", length=12, nullable=false)
     */
    private $telefonoLaboral;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=45, nullable=true)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=250, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="establecimiento_id", type="integer", nullable=false)
     */
    private $establecimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime", nullable=false)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=false)
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
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     * })
     */
    private $ciudad;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;


    /* CONSTRUCT */
    public function __construct()
    {
        $this->creationTime = new \DateTime();
        $this->updateTime = new \DateTime();
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Padre
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
     * Set apellido
     *
     * @param string $apellido
     * @return Padre
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Padre
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Padre
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
     * Set direccionLaboral
     *
     * @param string $direccionLaboral
     * @return Padre
     */
    public function setDireccionLaboral($direccionLaboral)
    {
        $this->direccionLaboral = $direccionLaboral;

        return $this;
    }

    /**
     * Get direccionLaboral
     *
     * @return string
     */
    public function getDireccionLaboral()
    {
        return $this->direccionLaboral;
    }

    /**
     * Set codigoPostal
     *
     * @param string $codigoPostal
     * @return Padre
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
     * Set codigoPais
     *
     * @param string $codigoPais
     * @return Padre
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
     * @return Padre
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
     * @return Padre
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
     * Set celular
     *
     * @param string $celular
     * @return Padre
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set telefonoLaboral
     *
     * @param string $telefonoLaboral
     * @return Padre
     */
    public function setTelefonoLaboral($telefonoLaboral)
    {
        $this->telefonoLaboral = $telefonoLaboral;

        return $this;
    }

    /**
     * Get telefonoLaboral
     *
     * @return string
     */
    public function getTelefonoLaboral()
    {
        return $this->telefonoLaboral;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     * @return Padre
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Padre
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
     * Set establecimiento
     *
     * @param integer $establecimiento
     * @return Padre
     */
    public function setEstablecimiento($establecimiento)
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return Establecimiento
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Padre
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
     * @return Padre
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
     * @return Padre
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
     * Set usuario
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuario
     * @return Padre
     */
    public function setUsuario(\Acme\boletinesBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Acme\boletinesBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
