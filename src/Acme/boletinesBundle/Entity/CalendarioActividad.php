<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarioActividad
 *
 * @ORM\Table(name="calendario_actividad", indexes={@ORM\Index(name="calendario_fk_actividad", columns={"id_calendario"}), @ORM\Index(name="actividad_fk_calendario", columns={"id_actividad"})})
 * @ORM\Entity
 */
class CalendarioActividad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_calendario_actividad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCalendarioActividad;

    /**
     * @var \Acme\boletinesBundle\Entity\Calendario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Calendario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_calendario", referencedColumnName="id_calendario")
     * })
     */
    private $idCalendario;

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
     * Get idCalendarioActividad
     *
     * @return integer 
     */
    public function getIdCalendarioActividad()
    {
        return $this->idCalendarioActividad;
    }

    /**
     * Set idCalendario
     *
     * @param \Acme\boletinesBundle\Entity\Calendario $idCalendario
     * @return CalendarioActividad
     */
    public function setIdCalendario(\Acme\boletinesBundle\Entity\Calendario $idCalendario = null)
    {
        $this->idCalendario = $idCalendario;

        return $this;
    }

    /**
     * Get idCalendario
     *
     * @return \Acme\boletinesBundle\Entity\Calendario 
     */
    public function getIdCalendario()
    {
        return $this->idCalendario;
    }

    /**
     * Set idActividad
     *
     * @param \Acme\boletinesBundle\Entity\Actividad $idActividad
     * @return CalendarioActividad
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
