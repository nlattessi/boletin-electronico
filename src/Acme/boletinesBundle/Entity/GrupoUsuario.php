<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoUsuario
 *
 * @ORM\Table(name="grupo_usuario", indexes={@ORM\Index(name="usuario_carga_fk_grupo_usuario", columns={"id_usuario_carga"})})
 * @ORM\Entity
 */
class GrupoUsuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_grupo_usuario", type="string", length=45, nullable=false)
     */
    private $nombreGrupoUsuario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_privado", type="boolean", nullable=false)
     */
    private $esPrivado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_grupo_usuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrupoUsuario;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_carga", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioCarga;


}
