<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="disciplina")
 */
class Disciplina
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Alumno")
     * @ORM\JoinColumn(name="alumno_id", referencedColumnName="id", nullable=false)
     */
    protected $alumno;

    /**
     * @ORM\Column(type="text")
     */
    protected $comentario;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descargo_alumno;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_suceso;

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
        return 'Alumno: ' . $this->getAlumno()->__toString() . ' el dia '. $this->getFechaSuceso()->format('d-m-Y');
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
     * Set comentario
     *
     * @param string $comentario
     * @return Disciplina
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
     * Set descargo_alumno
     *
     * @param string $descargoAlumno
     * @return Disciplina
     */
    public function setDescargoAlumno($descargoAlumno)
    {
        $this->descargo_alumno = $descargoAlumno;

        return $this;
    }

    /**
     * Get descargo_alumno
     *
     * @return string 
     */
    public function getDescargoAlumno()
    {
        return $this->descargo_alumno;
    }

    /**
     * Set fecha_suceso
     *
     * @param \DateTime $fechaSuceso
     * @return Disciplina
     */
    public function setFechaSuceso($fechaSuceso)
    {
        $this->fecha_suceso = $fechaSuceso;

        return $this;
    }

    /**
     * Get fecha_suceso
     *
     * @return \DateTime 
     */
    public function getFechaSuceso()
    {
        return $this->fecha_suceso;
    }

    /**
     * Set fue_validado
     *
     * @param boolean $fueValidado
     * @return Disciplina
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
     * @return Disciplina
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
     * @return Disciplina
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
     * Set usuario_carga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Disciplina
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
