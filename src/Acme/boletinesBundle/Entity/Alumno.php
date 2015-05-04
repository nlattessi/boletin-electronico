<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", indexes={@ORM\Index(name="padre2_fk_alumno", columns={"id_usuario_padre2"}), @ORM\Index(name="usuarior_fk_alumno", columns={"id_usuario_alumno"}), @ORM\Index(name="padre1_fk_alumno", columns={"id_usuario_padre1"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_alumno", type="string", length=45, nullable=false)
     */
    private $nombreAlumno;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_alumno", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAlumno;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_alumno", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioAlumno;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_padre1", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioPadre1;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_padre2", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioPadre2;


}
