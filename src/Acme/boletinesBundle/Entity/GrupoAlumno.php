<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoAlumno
 *
 * @ORM\Table(name="grupo_alumno")
 * @ORM\Entity
 */
class GrupoAlumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_grupo_alumno", type="string", length=45, nullable=false)
     */
    private $nombreGrupoAlumno;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_curso", type="boolean", nullable=false)
     */
    private $esCurso;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_grupo_alumno", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrupoAlumno;


}
