<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlumnoGrupoAlumno
 *
 * @ORM\Table(name="alumno_grupo_alumno")
 * @ORM\Entity
 */
class AlumnoGrupoAlumno
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime", nullable=true)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\GrupoAlumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoAlumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_alumno_id", referencedColumnName="id")
     * })
     */
    private $grupoAlumno;

    /**
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */
    private $alumno;



    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return AlumnoGrupoAlumno
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return \DateTime 
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return AlumnoGrupoAlumno
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
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
     * Set grupoAlumno
     *
     * @param \Acme\boletinesBundle\Entity\GrupoAlumno $grupoAlumno
     * @return AlumnoGrupoAlumno
     */
    public function setGrupoAlumno(\Acme\boletinesBundle\Entity\GrupoAlumno $grupoAlumno = null)
    {
        $this->grupoAlumno = $grupoAlumno;

        return $this;
    }

    /**
     * Get grupoAlumno
     *
     * @return \Acme\boletinesBundle\Entity\GrupoAlumno 
     */
    public function getGrupoAlumno()
    {
        return $this->grupoAlumno;
    }

    /**
     * Set alumno
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumno
     * @return AlumnoGrupoAlumno
     */
    public function setAlumno(\Acme\boletinesBundle\Entity\Alumno $alumno = null)
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
}
