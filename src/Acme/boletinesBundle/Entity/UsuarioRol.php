<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioRol
 *
 * @ORM\Table(name="usuario_rol", indexes={@ORM\Index(name="usuario_fk_rol", columns={"id_usuario"}), @ORM\Index(name="rol_fk_usuario", columns={"id_rol"})})
 * @ORM\Entity
 */
class UsuarioRol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario_rol", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuarioRol;

    /**
     * @var \Acme\boletinesBundle\Entity\Rol
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rol", referencedColumnName="id_rol")
     * })
     */
    private $idRol;

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
