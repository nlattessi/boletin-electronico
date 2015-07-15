<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examen", indexes={@ORM\Index(name="docente_fk_examen", columns={"id_docente"}), @ORM\Index(name="materia_fk_examen", columns={"id_materia"}), @ORM\Index(name="actividad_fk_examen", columns={"id_actividad"})})
 * @ORM\Entity
 */
class Examen
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_examen", type="string", length=45, nullable=false)
     */
    private $nombreExamen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_examen", type="datetime", nullable=false)
     */
    private $fechaExamen;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_examen", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExamen;

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
     * @var \Acme\boletinesBundle\Entity\Docente
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Docente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_docente", referencedColumnName="id_docente")
     * })
     */
    private $idDocente;

    /**
     * @var \Acme\boletinesBundle\Entity\Actividad
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Actividad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_actividad", referencedColumnName="id_actividad")
     * })
     */
    private $idActividad;



    /**
     * Set nombreExamen
     *
     * @param string $nombreExamen
     * @return Examen
     */
    public function setNombreExamen($nombreExamen)
    {
        $this->nombreExamen = $nombreExamen;

        return $this;
    }

    /**
     * Get nombreExamen
     *
     * @return string 
     */
    public function getNombreExamen()
    {
        return $this->nombreExamen;
    }

    /**
     * Set fechaExamen
     *
     * @param \DateTime $fechaExamen
     * @return Examen
     */
    public function setFechaExamen($fechaExamen)
    {
        $this->fechaExamen = $fechaExamen;

        return $this;
    }

    /**
     * Get fechaExamen
     *
     * @return \DateTime 
     */
    public function getFechaExamen()
    {
        return $this->fechaExamen;
    }

    /**
     * Get idExamen
     *
     * @return integer 
     */
    public function getIdExamen()
    {
        return $this->idExamen;
    }

    /**
     * Set idMateria
     *
     * @param \Acme\boletinesBundle\Entity\Materia $idMateria
     * @return Examen
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
     * Set idDocente
     *
     * @param \Acme\boletinesBundle\Entity\Docente $idDocente
     * @return Examen
     */
    public function setIdDocente(\Acme\boletinesBundle\Entity\Docente $idDocente = null)
    {
        $this->idDocente = $idDocente;

        return $this;
    }

    /**
     * Get idDocente
     *
     * @return \Acme\boletinesBundle\Entity\Docente 
     */
    public function getIdDocente()
    {
        return $this->idDocente;
    }

    /**
     * Set idActividad
     *
     * @param \Acme\boletinesBundle\Entity\Actividad $idActividad
     * @return Examen
     */
    public function setIdActividad(\Acme\boletinesBundle\Entity\Actividad $idActividad = null)
    {
        $this->idActividad = $idActividad;

        return $this;
    }

    /**
     * Get idActividad
     *
     * @return \Acme\boletinesBundle\Entity\Actividad 
     */
    public function getIdActividad()
    {
        return $this->idActividad;
    }
}
