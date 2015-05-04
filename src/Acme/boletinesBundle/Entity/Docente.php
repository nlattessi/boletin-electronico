<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Docente
 *
 * @ORM\Table(name="docente", indexes={@ORM\Index(name="usuario_fk_docente", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Docente
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_docente", type="string", length=45, nullable=false)
     */
    private $nombreDocente;

    /**
     * @var string
     *
     * @ORM\Column(name="email_docente", type="string", length=45, nullable=false)
     */
    private $emailDocente;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_docente", type="string", length=45, nullable=false)
     */
    private $telefonoDocente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_docente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDocente;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;


}
