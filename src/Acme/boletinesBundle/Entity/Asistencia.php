<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="asistencia")
 */
class Asistencia
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Materia")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id", nullable=false)
     */
    protected $materia;

    /**
     * @ORM\Column(type="date")
     */
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_carga_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario_carga;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_carga;

    public function __construct()
    {
        $this->fecha_carga = new \DateTime();
    }

    public function __toString()
    {
        return 'Asistencia del dia' . $this->getFechaAsistencia()->format('d-m-Y');
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Asistencia
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
     * Set fecha_carga
     *
     * @param \DateTime $fechaCarga
     * @return Asistencia
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fecha_carga = $fechaCarga;

        return $this;
    }

    /**
     * Get fecha_carga
     *
     * @return \DateTime 
     */
    public function getFechaCarga()
    {
        return $this->fecha_carga;
    }

    /**
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return Asistencia
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
     * Set usuario_carga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Asistencia
     */
    public function setUsuarioCarga(\Acme\boletinesBundle\Entity\Usuario $usuarioCarga)
    {
        $this->usuario_carga = $usuarioCarga;

        return $this;
    }

    /**
     * Get usuario_carga
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuarioCarga()
    {
        return $this->usuario_carga;
    }
}
