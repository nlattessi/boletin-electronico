<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MateriaDiaHorario
 *
 * @ORM\Table(name="materia_dia_horario", indexes={@ORM\Index(name="materia_fk_dia_hora", columns={"id_materia"})})
 * @ORM\Entity
 */
class MateriaDiaHorario
{
    /**
     * @var string
     *
     * @ORM\Column(name="dia", type="string", length=10, nullable=false)
     */
    private $dia;

    /**
     * @var integer
     *
     * @ORM\Column(name="hora_catedra_inicio", type="integer", nullable=false)
     */
    private $horaCatedraInicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="hora_catedra_fin", type="integer", nullable=false)
     */
    private $horaCatedraFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_materia_dia_horario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMateriaDiaHorario;

    /**
     * @var \Acme\boletinesBundle\Entity\Materia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Materia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_materia", referencedColumnName="id_materia")
     * })
     */
    private $idMateria;


}
