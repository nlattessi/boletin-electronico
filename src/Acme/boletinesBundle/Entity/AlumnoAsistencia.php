<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlumnoAsistencia
 *
 * @ORM\Table(name="alumno_asistencia", indexes={@ORM\Index(name="alumno_fk_asistencia", columns={"id_alumno"}), @ORM\Index(name="asistencia_fk_alumno", columns={"id_asistencia"}), @ORM\Index(name="justificacion_fk_alumno", columns={"id_justificacion"})})
 * @ORM\Entity
 */
class AlumnoAsistencia
{
    /**
     * @var string
     *
     * @ORM\Column(name="valor_asistencia", type="string", length=1, nullable=false)
     */
    private $valorAsistencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_alumno_asistencia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAlumnoAsistencia;

    /**
     * @var \Acme\boletinesBundle\Entity\Justificacion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Justificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_justificacion", referencedColumnName="id_justificacion")
     * })
     */
    private $idJustificacion;

    /**
     * @var \Acme\boletinesBundle\Entity\Asistencia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Asistencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asistencia", referencedColumnName="id_asistencia")
     * })
     */
    private $idAsistencia;

    /**
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alumno", referencedColumnName="id_alumno")
     * })
     */
    private $idAlumno;

    /**
     * @return string
     */
    public function getValorAsistencia()
    {
        return $this->valorAsistencia;
    }

    /**
     * @param string $valorAsistencia
     */
    public function setValorAsistencia($valorAsistencia)
    {
        $this->valorAsistencia = $valorAsistencia;
    }

    /**
     * @return int
     */
    public function getIdAlumnoAsistencia()
    {
        return $this->idAlumnoAsistencia;
    }

    /**
     * @param int $idAlumnoAsistencia
     */
    public function setIdAlumnoAsistencia($idAlumnoAsistencia)
    {
        $this->idAlumnoAsistencia = $idAlumnoAsistencia;
    }

    /**
     * @return Justificacion
     */
    public function getJustificacion()
    {
        return $this->idJustificacion;
    }

    /**
     * @param Justificacion $idJustificacion
     */
    public function setJustificacion($idJustificacion)
    {
        $this->idJustificacion = $idJustificacion;
    }

    /**
     * @return Asistencia
     */
    public function getAsistencia()
    {
        return $this->idAsistencia;
    }

    /**
     * @param Asistencia $idAsistencia
     */
    public function setAsistencia($idAsistencia)
    {
        $this->idAsistencia = $idAsistencia;
    }

    /**
     * @return Alumno
     */
    public function getAlumno()
    {
        return $this->idAlumno;
    }

    /**
     * @param Alumno $idAlumno
     */
    public function setAlumno($idAlumno)
    {
        $this->idAlumno = $idAlumno;
    }

    public function __toString(){
        return $this->getAsistencia()->__toString();
    }
}
