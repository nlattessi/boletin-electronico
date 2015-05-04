<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notificacion
 *
 * @ORM\Table(name="notificacion", indexes={@ORM\Index(name="usuario_envia_fk_notificacion", columns={"id_usuario_envia"}), @ORM\Index(name="grupo_usuario_fk_notificacion", columns={"id_grupo_usuario_recibe"})})
 * @ORM\Entity
 */
class Notificacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="titulo_notificacion", type="string", length=100, nullable=false)
     */
    private $tituloNotificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="texto_notificacion", type="string", length=500, nullable=false)
     */
    private $textoNotificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_envio", type="datetime", nullable=false)
     */
    private $fechaEnvio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_notificacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotificacion;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_envia", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioEnvia;

    /**
     * @var \Acme\boletinesBundle\Entity\GrupoUsuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_usuario_recibe", referencedColumnName="id_grupo_usuario")
     * })
     */
    private $idGrupoUsuarioRecibe;


}
