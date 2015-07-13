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

    /**
     * @return string
     */
    public function getTituloMensaje()
    {
        return $this->tituloMensaje;
    }

    /**
     * @param string $tituloMensaje
     */
    public function setTituloMensaje($tituloMensaje)
    {
        $this->tituloMensaje = $tituloMensaje;
    }

    /**
     * @return string
     */
    public function getTextoMensaje()
    {
        return $this->textoMensaje;
    }

    /**
     * @param string $textoMensaje
     */
    public function setTextoMensaje($textoMensaje)
    {
        $this->textoMensaje = $textoMensaje;
    }

    /**
     * @return \DateTime
     */
    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
    }

    /**
     * @param \DateTime $fechaEnvio
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fechaEnvio = $fechaEnvio;
    }

    /**
     * @return boolean
     */
    public function isBorrado()
    {
        return $this->borrado;
    }

    /**
     * @param boolean $borrado
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;
    }

    /**
     * @return int
     */
    public function getIdMensaje()
    {
        return $this->idMensaje;
    }

    /**
     * @param int $idMensaje
     */
    public function setIdMensaje($idMensaje)
    {
        $this->idMensaje = $idMensaje;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioRecibe()
    {
        return $this->idUsuarioRecibe;
    }

    /**
     * @param Usuario $idUsuarioRecibe
     */
    public function setUsuarioRecibe($idUsuarioRecibe)
    {
        $this->idUsuarioRecibe = $idUsuarioRecibe;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioEnvia()
    {
        return $this->idUsuarioEnvia;
    }

    /**
     * @param Usuario $idUsuarioEnvia
     */
    public function setUsuarioEnvia($idUsuarioEnvia)
    {
        $this->idUsuarioEnvia = $idUsuarioEnvia;
    }

    public function __toString(){
        return $this->getTituloMensaje();
    }

    /**
     * Get borrado
     *
     * @return boolean 
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Set idUsuarioRecibe
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioRecibe
     * @return Mensaje
     */
    public function setIdUsuarioRecibe(\Acme\boletinesBundle\Entity\Usuario $idUsuarioRecibe = null)
    {
        $this->idUsuarioRecibe = $idUsuarioRecibe;

        return $this;
    }

    /**
     * Get idUsuarioRecibe
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getIdUsuarioRecibe()
    {
        return $this->idUsuarioRecibe;
    }

    /**
     * Set idUsuarioEnvia
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioEnvia
     * @return Mensaje
     */
    public function setIdUsuarioEnvia(\Acme\boletinesBundle\Entity\Usuario $idUsuarioEnvia = null)
    {
        $this->idUsuarioEnvia = $idUsuarioEnvia;

        return $this;
    }

    /**
     * Get idUsuarioEnvia
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getIdUsuarioEnvia()
    {
        return $this->idUsuarioEnvia;
    }
}
