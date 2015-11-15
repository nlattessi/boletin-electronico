<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluacion
 *
 * @ORM\Table(name="evaluacion", indexes={@ORM\Index(name="FK_514C8FEC230266D4", columns={"docente_id"}), @ORM\Index(name="FK_514C8FECB36DFBF4", columns={"materia_id"}), @ORM\Index(name="FK_514C8FECDC70121", columns={"actividad_id"})})
 * @ORM\Entity
 */
class Evaluacion
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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

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
     * @var \Acme\boletinesBundle\Entity\Actividad
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Actividad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actividad_id", referencedColumnName="id")
     * })
     */
    private $actividad;

    /**
     * @var \Acme\boletinesBundle\Entity\Materia
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="evaluaciones")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     *
     */
    private $materia;

    /**
     * @var \Acme\boletinesBundle\Entity\Docente
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Docente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="docente_id", referencedColumnName="id")
     * })
     */
    private $docente;

    /**
     * @var boolean
     */
    private $calificada;

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Evaluacion
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Evaluacion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Evaluacion
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
     * @return Evaluacion
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
     * Set actividad
     *
     * @param \Acme\boletinesBundle\Entity\Actividad $actividad
     * @return Evaluacion
     */
    public function setActividad(\Acme\boletinesBundle\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return \Acme\boletinesBundle\Entity\Actividad 
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return Evaluacion
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
     * Set docente
     *
     * @param \Acme\boletinesBundle\Entity\Docente $docente
     * @return Evaluacion
     */
    public function setDocente(\Acme\boletinesBundle\Entity\Docente $docente = null)
    {
        $this->docente = $docente;

        return $this;
    }

    /**
     * Get docente
     *
     * @return \Acme\boletinesBundle\Entity\Docente 
     */
    public function getDocente()
    {
        return $this->docente;
    }

    /**
     * @return boolean
     */
    public function isCalificada()
    {
        return $this->calificada;
    }

    /**
     * @param boolean $calificada
     */
    public function setCalificada($calificada)
    {
        $this->calificada = $calificada;
    }



    public function __toString(){
        return $this->getNombre();
    }
}
