<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="alumno_asistencia")
 */
class AlumnoAsistencia
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
     * @ORM\ManyToOne(targetEntity="Asistencia")
     * @ORM\JoinColumn(name="asistencia_id", referencedColumnName="id", nullable=false)
     */
    protected $asistencia;

    /**
     * @ORM\ManyToOne(targetEntity="Justificacion")
     * @ORM\JoinColumn(name="justificacion_id", referencedColumnName="id", nullable=true)
     */
    protected $justificacion;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $valor;

    public function __toString()
    {
        return $this->getAsistencia()->__toString();
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
     * Set valor
     *
     * @param string $valor
     * @return AlumnoAsistencia
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
     * Set alumno
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumno
     * @return AlumnoAsistencia
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
     * Set asistencia
     *
     * @param \Acme\boletinesBundle\Entity\Asistencia $asistencia
     * @return AlumnoAsistencia
     */
    public function setAsistencia(\Acme\boletinesBundle\Entity\Asistencia $asistencia)
    {
        $this->asistencia = $asistencia;

        return $this;
    }

    /**
     * Get asistencia
     *
     * @return \Acme\boletinesBundle\Entity\Asistencia 
     */
    public function getAsistencia()
    {
        return $this->asistencia;
    }

    /**
     * Set justificacion
     *
     * @param \Acme\boletinesBundle\Entity\Justificacion $justificacion
     * @return AlumnoAsistencia
     */
    public function setJustificacion(\Acme\boletinesBundle\Entity\Justificacion $justificacion = null)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return \Acme\boletinesBundle\Entity\Justificacion 
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }
}
