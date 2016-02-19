<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Convivencia
 *
 * @ORM\Table(name="convivencia", indexes={@ORM\Index(name="FK_72D32A26320260C0", columns={"alumno_id"}), @ORM\Index(name="FK_72D32A26230266D4", columns={"usuario_carga_id"})})
 * @ORM\Entity
 */
class Convivencia
{
    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=250, nullable=false)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="descargo", type="string", length=250, nullable=true)
     */
    private $descargo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_suceso", type="datetime", nullable=false)
     */
    private $fechaSuceso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validado", type="boolean", nullable=true)
     */
    private $validado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valor", type="boolean", nullable=true)
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */
    private $alumno;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_carga_id", referencedColumnName="id")
     * })
     */
    private $usuarioCarga;


    /**
     * @var boolean
     */
    private $activo = true;


    public function __construct() {
        $this->creationTime = new \DateTime();
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Convivencia
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set descargo
     *
     * @param string $descargo
     * @return Convivencia
     */
    public function setDescargo($descargo)
    {
        $this->descargo = $descargo;

        return $this;
    }

    /**
     * Get descargo
     *
     * @return string 
     */
    public function getDescargo()
    {
        return $this->descargo;
    }

    /**
     * Set fechaSuceso
     *
     * @param \DateTime $fechaSuceso
     * @return Convivencia
     */
    public function setFechaSuceso($fechaSuceso)
    {
        $this->fechaSuceso = $fechaSuceso;

        return $this;
    }

    /**
     * Get fechaSuceso
     *
     * @return \DateTime 
     */
    public function getFechaSuceso()
    {
        return $this->fechaSuceso;
    }

    /**
     * Set validado
     *
     * @param boolean $validado
     * @return Convivencia
     */
    public function setValidado($validado)
    {
        $this->validado = $validado;

        return $this;
    }

    /**
     * Get validado
     *
     * @return boolean 
     */
    public function getValidado()
    {
        return $this->validado;
    }

    /**
     * Set valor
     *
     * @param boolean $valor
     * @return Convivencia
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return boolean 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Convivencia
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
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Convivencia
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
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
     * Set alumno
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumno
     * @return Convivencia
     */
    public function setAlumno(\Acme\boletinesBundle\Entity\Alumno $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return \Acme\boletinesBundle\Entity\Alumno 
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set usuarioCarga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Convivencia
     */
    public function setUsuarioCarga(\Acme\boletinesBundle\Entity\Usuario $usuarioCarga = null)
    {
        $this->usuarioCarga = $usuarioCarga;

        return $this;
    }

    /**
     * Get usuarioCarga
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuarioCarga()
    {
        return $this->usuarioCarga;
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


}
