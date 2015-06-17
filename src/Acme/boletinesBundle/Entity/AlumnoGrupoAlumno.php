<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="alumno_grupo_alumno")
 */
class AlumnoGrupoAlumno
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
     * @ORM\ManyToOne(targetEntity="GrupoAlumno")
     * @ORM\JoinColumn(name="grupo_alumno_id", referencedColumnName="id", nullable=false)
     */
    protected $grupo_alumno;

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
     * Set alumno
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumno
     * @return AlumnoGrupoAlumno
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
     * Set grupo_alumno
     *
     * @param \Acme\boletinesBundle\Entity\GrupoAlumno $grupoAlumno
     * @return AlumnoGrupoAlumno
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
}
