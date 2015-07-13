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

    /**
     * @return string
     */
    public function getTituloNotificacion()
    {
        return $this->tituloNotificacion;
    }

    /**
     * @param string $tituloNotificacion
     */
    public function setTituloNotificacion($tituloNotificacion)
    {
        $this->tituloNotificacion = $tituloNotificacion;
    }

    /**
     * @return string
     */
    public function getTextoNotificacion()
    {
        return $this->textoNotificacion;
    }

    /**
     * @param string $textoNotificacion
     */
    public function setTextoNotificacion($textoNotificacion)
    {
        $this->textoNotificacion = $textoNotificacion;
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
     * @return int
     */
    public function getIdNotificacion()
    {
        return $this->idNotificacion;
    }

    /**
     * @param int $idNotificacion
     */
    public function setIdNotificacion($idNotificacion)
    {
        $this->idNotificacion = $idNotificacion;
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

    /**
     * @return GrupoUsuario
     */
    public function getGrupoUsuarioRecibe()
    {
        return $this->idGrupoUsuarioRecibe;
    }

    /**
     * @param GrupoUsuario $idGrupoUsuarioRecibe
     */
    public function setGrupoUsuarioRecibe($idGrupoUsuarioRecibe)
    {
        $this->idGrupoUsuarioRecibe = $idGrupoUsuarioRecibe;
    }

    public function __toString(){
        return $this->getTituloNotificacion();
    }

    /**
     * Set idUsuarioEnvia
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioEnvia
     * @return Notificacion
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

    /**
     * Set idGrupoUsuarioRecibe
     *
     * @param \Acme\boletinesBundle\Entity\GrupoUsuario $idGrupoUsuarioRecibe
     * @return Notificacion
     */
    public function setIdGrupoUsuarioRecibe(\Acme\boletinesBundle\Entity\GrupoUsuario $idGrupoUsuarioRecibe = null)
    {
        $this->idGrupoUsuarioRecibe = $idGrupoUsuarioRecibe;

        return $this;
    }

    /**
     * Get idGrupoUsuarioRecibe
     *
     * @return \Acme\boletinesBundle\Entity\GrupoUsuario 
     */
    public function getIdGrupoUsuarioRecibe()
    {
        return $this->idGrupoUsuarioRecibe;
    }
}
