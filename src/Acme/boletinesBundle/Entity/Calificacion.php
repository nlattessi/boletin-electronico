<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="calificacion")
 */
class Calificacion
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Alumno")
     * @ORM\JoinColumn(name="alumno_id", referencedColumnName="id", nullable=false)
     */
    protected $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="Examen")
     * @ORM\JoinColumn(name="examen_id", referencedColumnName="id", nullable=false)
     */
    protected $examen;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha;

    /**
     * @ORM\Column(type="string")
     */
    protected $valor;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $comentario;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $fue_validado;

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
        return $this->getValorCalificacion();
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
     * @param string $valor
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
     * @return string 
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
     * Set fue_validado
     *
     * @param boolean $fueValidado
     * @return Calificacion
     */
    public function setFueValidado($fueValidado)
    {
        $this->fue_validado = $fueValidado;

        return $this;
    }

    /**
     * Get fue_validado
     *
     * @return boolean 
     */
    public function getFueValidado()
    {
        return $this->fue_validado;
    }

    /**
     * Set fecha_carga
     *
     * @param \DateTime $fechaCarga
     * @return Calificacion
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
     * Set alumno
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumno
     * @return Calificacion
     */
    public function setAlumno(\Acme\boletinesBundle\Entity\Alumno $alumno)
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
     * Set examen
     *
     * @param \Acme\boletinesBundle\Entity\Examen $examen
     * @return Calificacion
     */
    public function setExamen(\Acme\boletinesBundle\Entity\Examen $examen)
    {
        $this->examen = $examen;

        return $this;
    }

    /**
     * Get examen
     *
     * @return \Acme\boletinesBundle\Entity\Examen 
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * Set usuario_carga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Calificacion
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
