<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificacion
 *
 * @ORM\Table(name="calificacion", indexes={@ORM\Index(name="alumno_fk_examen_idx", columns={"id_alumno"}), @ORM\Index(name="examen_fk_calificacion_idx", columns={"id_examen"})})
 * @ORM\Entity
 */
class Calificacion
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_calificacion", type="datetime", nullable=true)
     */
    private $fechaCalificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_calificacion", type="string", length=10, nullable=true)
     */
    private $valorCalificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario_calificacion", type="string", length=127, nullable=true)
     */
    private $comentarioCalificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="validada", type="string", length=1, nullable=false)
     */
    private $validada;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_calificacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCalificacion;

    /**
     * @var \Acme\boletinesBundle\Entity\Examen
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Examen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_examen", referencedColumnName="id_examen")
     * })
     */
    private $idExamen;

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
     * @return \DateTime
     */
    public function getFechaCalificacion()
    {
        return $this->fechaCalificacion;
    }

    /**
     * @param \DateTime $fechaCalificacion
     */
    public function setFechaCalificacion($fechaCalificacion)
    {
        $this->fechaCalificacion = $fechaCalificacion;
    }

    /**
     * @return string
     */
    public function getValorCalificacion()
    {
        return $this->valorCalificacion;
    }

    /**
     * @param string $valorCalificacion
     */
    public function setValorCalificacion($valorCalificacion)
    {
        $this->valorCalificacion = $valorCalificacion;
    }

    /**
     * @return string
     */
    public function getComentarioCalificacion()
    {
        return $this->comentarioCalificacion;
    }

    /**
     * @param string $comentarioCalificacion
     */
    public function setComentarioCalificacion($comentarioCalificacion)
    {
        $this->comentarioCalificacion = $comentarioCalificacion;
    }

    /**
     * @return string
     */
    public function getValidada()
    {
        return $this->validada;
    }

    /**
     * @param string $validada
     */
    public function setValidada($validada)
    {
        $this->validada = $validada;
    }

    /**
     * @return int
     */
    public function getIdCalificacion()
    {
        return $this->idCalificacion;
    }

    /**
     * @param int $idCalificacion
     */
    public function setIdCalificacion($idCalificacion)
    {
        $this->idCalificacion = $idCalificacion;
    }

    /**
     * @return Examen
     */
    public function getExamen()
    {
        return $this->idExamen;
    }

    /**
     * @param Examen $idExamen
     */
    public function setExamen($idExamen)
    {
        $this->idExamen = $idExamen;
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
        return $this->getValorCalificacion();
    }
}
