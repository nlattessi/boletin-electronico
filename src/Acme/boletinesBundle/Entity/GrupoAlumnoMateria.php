<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoAlumnoMateria
 *
 * @ORM\Table(name="grupo_alumno_materia", indexes={@ORM\Index(name="grupo_alumno_fk_materia_idx", columns={"id_grupo_alumno"}), @ORM\Index(name="materia_fk_grupo_alumno_idx", columns={"id_materia"})})
 * @ORM\Entity
 */
class GrupoAlumnoMateria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_grupo_alumno_materia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrupoAlumnoMateria;

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
     * @var \Acme\boletinesBundle\Entity\GrupoAlumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoAlumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_alumno", referencedColumnName="id_grupo_alumno")
     * })
     */
    private $idGrupoAlumno;


}
