<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlumnoMateria
 *
 * @ORM\Table(name="alumno_materia", indexes={@ORM\Index(name="alumno_fk_materia_idx", columns={"id_alumno"}), @ORM\Index(name="materia_fk_alumno_idx", columns={"id_materia"})})
 * @ORM\Entity
 */
class AlumnoMateria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_alumno_materia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAlumnoMateria;

    /**
     * @var \Acme\boletinesBundle\Entity\Materia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Materia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_materia", referencedColumnName="id_materia")
     * })
     */
    private $idMateria;

    /**
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alumno", referencedColumnName="id_alumno")
     * })
     */
    private $idAlumno;

    public function AlumnoMateria($alumno, $materia){
        $this->setAlumno($alumno);
        $this->setMateria($materia);
    }


    /**
     * @return int
     */
    public function getIdAlumnoMateria()
    {
        return $this->idAlumnoMateria;
    }

    /**
     * @param int $idAlumnoMateria
     */
    public function setIdAlumnoMateria($idAlumnoMateria)
    {
        $this->idAlumnoMateria = $idAlumnoMateria;
    }

    /**
     * @return Materia
     */
    public function getMateria()
    {
        return $this->idMateria;
    }

    /**
     * @param Materia $idMateria
     */
    public function setMateria($idMateria)
    {
        $this->idMateria = $idMateria;
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



}
