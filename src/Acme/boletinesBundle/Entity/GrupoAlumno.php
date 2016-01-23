<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoAlumno
 *
 * @ORM\Table(name="grupo_alumno")
 * @ORM\Entity
 */
class GrupoAlumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_curso", type="boolean", nullable=false)
     */
    private $esCurso;

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
     * @var boolean
     */
    private $activo = true;

    private $establecimiento;

    private $alumnos;

    /* CONSTRUCT */
    public function __construct()
    {
        $this->alumnos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    /**
     * @param Alumno $alumno
     */
    public function addAlumno(Alumno $alumno)
    {
        $this->alumnos[] = $alumno;
    }

    /**
     * @return mixed
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * @param mixed $establecimiento
     */
    public function setEstablecimiento($establecimiento)
    {
        $this->establecimiento = $establecimiento;
    }



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return GrupoAlumno
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set esCurso
     *
     * @param boolean $esCurso
     * @return GrupoAlumno
     */
    public function setEsCurso($esCurso)
    {
        $this->esCurso = $esCurso;

        return $this;
    }

    /**
     * Get esCurso
     *
     * @return boolean 
     */
    public function getEsCurso()
    {
        return $this->esCurso;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return GrupoAlumno
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
     * @return GrupoAlumno
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
     * @return boolean
     */
    public function isActivo()
    {
        return $this->activo;
    }

    /**
     * @param boolean $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }



    public function __toString(){
        return $this->getNombre();
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Remove alumnos
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumnos
     */
    public function removeAlumno(\Acme\boletinesBundle\Entity\Alumno $alumnos)
    {
        $this->alumnos->removeElement($alumnos);
    }
}
