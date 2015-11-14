<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificacion
 *
 * @ORM\Table(name="calificacion", indexes={@ORM\Index(name="FK_8A3AF218320260C0", columns={"alumno_id"}), @ORM\Index(name="fk_calificacion_evaluacion", columns={"evaluacion_id"}), @ORM\Index(name="fk_usuario_calificacion_idx", columns={"usuario_carga_id"})})
 * @ORM\Entity
 */
class Calificacion
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var \Acme\boletinesBundle\Entity\ValorCalificacion
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=250, nullable=true)
     */
    private $comentario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion;

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
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_carga_id", referencedColumnName="id")
     * })
     */
    private $usuarioCarga;

    /**
     * @var \Acme\boletinesBundle\Entity\Evaluacion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Evaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evaluacion_id", referencedColumnName="id")
     * })
     */
    private $evaluacion;

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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Calificacion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set valor
     *
     * @param ValorCalificacion $valor
     * @return Calificacion
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return ValorCalificacion
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Calificacion
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
     * Set validada
     *
     * @param boolean $validada
     * @return Calificacion
     */
    public function setValidada($validada)
    {
        $this->validada = $validada;

        return $this;
    }

    /**
     * Get validada
     *
     * @return boolean 
     */
    public function getValidada()
    {
        return $this->validada;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Calificacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Calificacion
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
     * Set usuarioCarga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Calificacion
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
     * Set evaluacion
     *
     * @param \Acme\boletinesBundle\Entity\Evaluacion $evaluacion
     * @return Calificacion
     */
    public function setEvaluacion(\Acme\boletinesBundle\Entity\Evaluacion $evaluacion = null)
    {
        $this->evaluacion = $evaluacion;

        return $this;
    }

    /**
     * Get evaluacion
     *
     * @return \Acme\boletinesBundle\Entity\Evaluacion 
     */
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }

    /**
     * Set alumno
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumno
     * @return Calificacion
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
     * @var boolean
     */
    private $validada;


}
