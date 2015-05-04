<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disciplina
 *
 * @ORM\Table(name="disciplina", indexes={@ORM\Index(name="alumno_fk_disciplina", columns={"id_alumno"}), @ORM\Index(name="docente_fk_disciplina", columns={"id_docente"})})
 * @ORM\Entity
 */
class Disciplina
{
    /**
     * @var string
     *
     * @ORM\Column(name="comentario_docente", type="string", length=255, nullable=false)
     */
    private $comentarioDocente;

    /**
     * @var string
     *
     * @ORM\Column(name="descargo_alumno", type="string", length=255, nullable=true)
     */
    private $descargoAlumno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_suceso", type="datetime", nullable=false)
     */
    private $fechaSuceso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carga", type="datetime", nullable=false)
     */
    private $fechaCarga;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validado", type="boolean", nullable=true)
     */
    private $validado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_disciplina", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDisciplina;

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
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alumno", referencedColumnName="id_alumno")
     * })
     */
    private $idAlumno;


}
