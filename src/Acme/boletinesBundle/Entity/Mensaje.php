<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensaje
 *
 * @ORM\Table(name="mensaje", indexes={@ORM\Index(name="usuario_envia_fk_mensaje", columns={"id_usuario_envia"}), @ORM\Index(name="usuario_recibe_fk_mensaje", columns={"id_usuario_recibe"})})
 * @ORM\Entity
 */
class Mensaje
{
    /**
     * @var string
     *
     * @ORM\Column(name="titulo_mensaje", type="string", length=100, nullable=false)
     */
    private $tituloMensaje;

    /**
     * @var string
     *
     * @ORM\Column(name="texto_mensaje", type="string", length=500, nullable=false)
     */
    private $textoMensaje;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_envio", type="datetime", nullable=false)
     */
    private $fechaEnvio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=false)
     */
    private $borrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_mensaje", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMensaje;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_recibe", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioRecibe;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_envia", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioEnvia;


}
