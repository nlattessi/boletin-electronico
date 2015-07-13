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

    public function CalendarioActividad($calendario, $actividad){
        $this->setCalendario($calendario);
        $this->setActividad($actividad);
    }


    /**
     * @return int
     */
    public function getIdCalendarioActividad()
    {
        return $this->idCalendarioActividad;
    }

    /**
     * @param int $idCalendarioActividad
     */
    public function setIdCalendarioActividad($idCalendarioActividad)
    {
        $this->idCalendarioActividad = $idCalendarioActividad;
    }

    /**
     * @return Calendario
     */
    public function getCalendario()
    {
        return $this->idCalendario;
    }

    /**
     * @param Calendario $idCalendario
     */
    public function setCalendario($idCalendario)
    {
        $this->idCalendario = $idCalendario;
    }

    /**
     * @return Actividad
     */
    public function getActividad()
    {
        return $this->idActividad;
    }

    /**
     * @param Actividad $idActividad
     */
    public function setActividad($idActividad)
    {
        $this->idActividad = $idActividad;
    }


}
