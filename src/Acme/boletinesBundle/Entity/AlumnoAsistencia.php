<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlumnoAsistencia
 *
 * @ORM\Table(name="alumno_asistencia", indexes={@ORM\Index(name="alumno_fk_asistencia", columns={"id_alumno"}), @ORM\Index(name="asistencia_fk_alumno", columns={"id_asistencia"}), @ORM\Index(name="justificacion_fk_alumno", columns={"id_justificacion"})})
 * @ORM\Entity
 */
class AlumnoAsistencia
{
    /**
     * @var string
     *
     * @ORM\Column(name="valor_asistencia", type="string", length=1, nullable=false)
     */
    private $valorAsistencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_alumno_asistencia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAlumnoAsistencia;

    /**
     * @var \Acme\boletinesBundle\Entity\Justificacion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Justificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_justificacion", referencedColumnName="id_justificacion")
     * })
     */
    private $idJustificacion;

    /**
     * @var \Acme\boletinesBundle\Entity\Asistencia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Asistencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asistencia", referencedColumnName="id_asistencia")
     * })
     */
    private $idAsistencia;

    /**
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alumno", referencedColumnName="id_alumno")
     * })
     */
    private $idAlumno;


}
