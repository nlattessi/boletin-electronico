<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoAlumnoMateria
 *
 * @ORM\Table(name="grupo_alumno_materia", indexes={@ORM\Index(name="grupo_alumno_fk_materia_idx", columns={"id_grupo_alumno"}), @ORM\Index(name="materia_fk_grupo_alumno_idx", columns={"id_materia"})})
 * @ORM\Entity
 */
class GrupoAlumnoMateria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_grupo_alumno_materia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrupoAlumnoMateria;

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
     * @var \Acme\boletinesBundle\Entity\GrupoAlumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoAlumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_alumno", referencedColumnName="id_grupo_alumno")
     * })
     */
    private $idGrupoAlumno;

    public function GrupoAlumnoMateria($grupoAlumno, $materia){
        $this->setGrupoAlumno($grupoAlumno);
        $this->setMateria($materia);
    }

    /**
     * @return int
     */
    public function getIdGrupoAlumnoMateria()
    {
        return $this->idGrupoAlumnoMateria;
    }

    /**
     * @param int $idGrupoAlumnoMateria
     */
    public function setIdGrupoAlumnoMateria($idGrupoAlumnoMateria)
    {
        $this->idGrupoAlumnoMateria = $idGrupoAlumnoMateria;
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
     * @return GrupoAlumno
     */
    public function getGrupoAlumno()
    {
        return $this->idGrupoAlumno;
    }

    /**
     * @param GrupoAlumno $idGrupoAlumno
     */
    public function setGrupoAlumno($idGrupoAlumno)
    {
        $this->idGrupoAlumno = $idGrupoAlumno;
    }



    /**
     * Set idMateria
     *
     * @param \Acme\boletinesBundle\Entity\Materia $idMateria
     * @return GrupoAlumnoMateria
     */
    public function setIdMateria(\Acme\boletinesBundle\Entity\Materia $idMateria = null)
    {
        $this->idMateria = $idMateria;

        return $this;
    }

    /**
     * Get idMateria
     *
     * @return \Acme\boletinesBundle\Entity\Materia 
     */
    public function getIdMateria()
    {
        return $this->idMateria;
    }

    /**
     * Set idGrupoAlumno
     *
     * @param \Acme\boletinesBundle\Entity\GrupoAlumno $idGrupoAlumno
     * @return GrupoAlumnoMateria
     */
    public function setIdGrupoAlumno(\Acme\boletinesBundle\Entity\GrupoAlumno $idGrupoAlumno = null)
    {
        $this->idGrupoAlumno = $idGrupoAlumno;

        return $this;
    }

    /**
     * Get idGrupoAlumno
     *
     * @return \Acme\boletinesBundle\Entity\GrupoAlumno 
     */
    public function getIdGrupoAlumno()
    {
        return $this->idGrupoAlumno;
    }
}
