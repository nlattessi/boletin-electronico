<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="examen")
 */
class Examen
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Docente")
     * @ORM\JoinColumn(name="docente_id", referencedColumnName="id", nullable=false)
     */
    protected $docente;

    /**
     * @ORM\ManyToOne(targetEntity="Materia")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id", nullable=false)
     */
    protected $materia;

    /**
     * @ORM\ManyToOne(targetEntity="Actividad")
     * @ORM\JoinColumn(name="actividad_id", referencedColumnName="id", nullable=false)
     */
    protected $actividad;

    public function __toString()
    {
        return  $this->getNombre();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Examen
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
     * @return Examen
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
     * Set docente
     *
     * @param \Acme\boletinesBundle\Entity\Docente $docente
     * @return Examen
     */
    public function setDocente(\Acme\boletinesBundle\Entity\Docente $docente)
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
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return Examen
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

    /**
     * Set actividad
     *
     * @param \Acme\boletinesBundle\Entity\Actividad $actividad
     * @return Examen
     */
    public function setActividad(\Acme\boletinesBundle\Entity\Actividad $actividad)
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
}
