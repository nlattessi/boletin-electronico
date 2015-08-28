<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materia
 *
 * @ORM\Table(name="materia", indexes={@ORM\Index(name="FK_6DF052845DC80656", columns={"tipo_materia_id"})})
 * @ORM\Entity
 */
class Materia
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

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
     * @var \Acme\boletinesBundle\Entity\TipoMateria
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\TipoMateria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_materia_id", referencedColumnName="id")
     * })
     */
    private $tipoMateria;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Acme\boletinesBundle\Entity\Institucion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Institucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="institucion_id", referencedColumnName="id")
     * })
     */
    //private $institucion;

    /**
     * @var \Acme\boletinesBundle\Entity\Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id")
     * })
     */
    private $establecimiento;

    private $alumnos;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Materia
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
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Materia
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
     * @return Materia
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
     * Set tipoMateria
     *
     * @param \Acme\boletinesBundle\Entity\TipoMateria $tipoMateria
     * @return Materia
     */
    public function setTipoMateria(\Acme\boletinesBundle\Entity\TipoMateria $tipoMateria = null)
    {
        $this->tipoMateria = $tipoMateria;

        return $this;
    }

    /**
     * Get tipoMateria
     *
     * @return \Acme\boletinesBundle\Entity\TipoMateria
     */
    public function getTipoMateria()
    {
        return $this->tipoMateria;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Rol
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set institucion
     *
     * @param \Acme\boletinesBundle\Entity\Institucion $institucion
     * @return Usuario
     */
    // public function setInstitucion(\Acme\boletinesBundle\Entity\Institucion $institucion = null)
    // {
    //     $this->institucion = $institucion;
    //
    //     return $this;
    // }

    /**
     * Get institucion
     *
     * @return \Acme\boletinesBundle\Entity\Institucion
     */
    // public function getInstitucion()
    // {
    //     return $this->institucion;
    // }

    /**
     * Set establecimiento
     *
     * @param \Acme\boletinesBundle\Entity\Establecimiento $establecimiento
     * @return Materia
     */
    public function setEstablecimiento(\Acme\boletinesBundle\Entity\Establecimiento $establecimiento = null)
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return \Acme\boletinesBundle\Entity\Establecimiento
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    public function getAlumnos()
    {
        return $this->alumnos;
    }

    public function addAlumno(\Acme\boletinesBundle\Entity\Alumno $alumno = null)
    {
        if (! $this->alumnos->alumnos-contains($alumno)) {
            $this->alumnos->add($alumno);
        }

        return $this;
    }

    public function removeAlumno(\Acme\boletinesBundle\Entity\Alumno $alumno = null)
    {
        if ($this->alumnos->contains($alumno)) {
            $this->alumnos->removeElement($alumno);
        }

        return $this;
    }

    /* CONSTRUCT */
    public function __construct()
    {
        $this->alumnos = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
