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


}
