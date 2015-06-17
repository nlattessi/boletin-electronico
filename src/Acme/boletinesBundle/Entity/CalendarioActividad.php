<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="calendario_actividad")
 */
class CalendarioActividad
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Calendario")
     * @ORM\JoinColumn(name="calendario_id", referencedColumnName="id", nullable=false)
     */
    protected $calendario;

    /**
     * @ORM\ManyToOne(targetEntity="Actividad")
     * @ORM\JoinColumn(name="actividad_id", referencedColumnName="id", nullable=false)
     */
    protected $actividad;

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
     * Set calendario
     *
     * @param \Acme\boletinesBundle\Entity\Calendario $calendario
     * @return CalendarioActividad
     */
    public function setCalendario(\Acme\boletinesBundle\Entity\Calendario $calendario)
    {
        $this->calendario = $calendario;

        return $this;
    }

    /**
     * Get calendario
     *
     * @return \Acme\boletinesBundle\Entity\Calendario 
     */
    public function getCalendario()
    {
        return $this->calendario;
    }

    /**
     * Set actividad
     *
     * @param \Acme\boletinesBundle\Entity\Actividad $actividad
     * @return CalendarioActividad
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
