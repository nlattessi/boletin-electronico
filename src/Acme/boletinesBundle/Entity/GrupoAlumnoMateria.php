<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoAlumnoMateria
 *
 * @ORM\Table(name="grupo_alumno_materia", indexes={@ORM\Index(name="FK_7B2FAA0D3BF20F66", columns={"grupo_alumno_id"}), @ORM\Index(name="FK_7B2FAA0DB36DFBF4", columns={"materia_id"})})
 * @ORM\Entity
 */
class GrupoAlumnoMateria
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
     * @var \Acme\boletinesBundle\Entity\Materia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Materia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     * })
     */
    private $materia;

    /**
     * @var \Acme\boletinesBundle\Entity\GrupoAlumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoAlumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_alumno_id", referencedColumnName="id")
     * })
     */
    private $grupoAlumno;


    public function __construct()
    {
        $this->creationTime = new \DateTime();
    }


    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return GrupoAlumnoMateria
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
     * @return GrupoAlumnoMateria
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
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return GrupoAlumnoMateria
     */
    public function setMateria(\Acme\boletinesBundle\Entity\Materia $materia = null)
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

    /**
     * Set grupoAlumno
     *
     * @param \Acme\boletinesBundle\Entity\GrupoAlumno $grupoAlumno
     * @return GrupoAlumnoMateria
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
    public function __toString(){
        return $this->getId() . "";
    }

}
