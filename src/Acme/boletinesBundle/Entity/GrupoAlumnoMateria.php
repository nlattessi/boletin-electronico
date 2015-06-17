<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="grupo_alumno_materia")
 */
class GrupoAlumnoMateria
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="GrupoAlumno")
     * @ORM\JoinColumn(name="grupo_alumno_id", referencedColumnName="id", nullable=false)
     */
    protected $grupo_alumno;

    /**
     * @ORM\ManyToOne(targetEntity="Materia")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id", nullable=false)
     */
    protected $materia;

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
     * Set grupo_alumno
     *
     * @param \Acme\boletinesBundle\Entity\GrupoAlumno $grupoAlumno
     * @return GrupoAlumnoMateria
     */
    public function setGrupoAlumno(\Acme\boletinesBundle\Entity\GrupoAlumno $grupoAlumno)
    {
        $this->grupo_alumno = $grupoAlumno;

        return $this;
    }

    /**
     * Get grupo_alumno
     *
     * @return \Acme\boletinesBundle\Entity\GrupoAlumno 
     */
    public function getGrupoAlumno()
    {
        return $this->grupo_alumno;
    }

    /**
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return GrupoAlumnoMateria
     */
    public function setMateria(\Acme\boletinesBundle\Entity\Materia $materia)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return \Acme\boletinesBundle\Entity\Materia 
     */
    public function getMateria()
    {
        return $this->materia;
    }
}
