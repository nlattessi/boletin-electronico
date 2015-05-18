<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disciplina
 *
 * @ORM\Table(name="disciplina", indexes={@ORM\Index(name="alumno_fk_disciplina", columns={"id_alumno"}), @ORM\Index(name="docente_fk_disciplina", columns={"id_docente"})})
 * @ORM\Entity
 */
class Disciplina
{
    /**
     * @var string
     *
     * @ORM\Column(name="comentario_docente", type="string", length=255, nullable=false)
     */
    private $comentarioDocente;

    /**
     * @var string
     *
     * @ORM\Column(name="descargo_alumno", type="string", length=255, nullable=true)
     */
    private $descargoAlumno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_suceso", type="datetime", nullable=false)
     */
    private $fechaSuceso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carga", type="datetime", nullable=false)
     */
    private $fechaCarga;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validado", type="boolean", nullable=true)
     */
    private $validado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_disciplina", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDisciplina;

    /**
     * @var \Acme\boletinesBundle\Entity\Docente
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Docente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_docente", referencedColumnName="id_docente")
     * })
     */
    private $idDocente;

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
    public function getComentarioDocente()
    {
        return $this->comentarioDocente;
    }

    /**
     * @param string $comentarioDocente
     */
    public function setComentarioDocente($comentarioDocente)
    {
        $this->comentarioDocente = $comentarioDocente;
    }

    /**
     * @return string
     */
    public function getDescargoAlumno()
    {
        return $this->descargoAlumno;
    }

    /**
     * @param string $descargoAlumno
     */
    public function setDescargoAlumno($descargoAlumno)
    {
        $this->descargoAlumno = $descargoAlumno;
    }

    /**
     * @return \DateTime
     */
    public function getFechaSuceso()
    {
        return $this->fechaSuceso;
    }

    /**
     * @param \DateTime $fechaSuceso
     */
    public function setFechaSuceso($fechaSuceso)
    {
        $this->fechaSuceso = $fechaSuceso;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }

    /**
     * @param \DateTime $fechaCarga
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;
    }

    /**
     * @return boolean
     */
    public function isValidado()
    {
        return $this->validado;
    }

    /**
     * @param boolean $validado
     */
    public function setValidado($validado)
    {
        $this->validado = $validado;
    }

    /**
     * @return int
     */
    public function getIdDisciplina()
    {
        return $this->idDisciplina;
    }

    /**
     * @param int $idDisciplina
     */
    public function setIdDisciplina($idDisciplina)
    {
        $this->idDisciplina = $idDisciplina;
    }

    /**
     * @return Docente
     */
    public function getDocente()
    {
        return $this->idDocente;
    }

    /**
     * @param Docente $idDocente
     */
    public function setDocente($idDocente)
    {
        $this->idDocente = $idDocente;
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
      return  $this->getComentarioDocente();
    }

}
