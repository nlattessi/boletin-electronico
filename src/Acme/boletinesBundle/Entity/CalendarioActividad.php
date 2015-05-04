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


}
