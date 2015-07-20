<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificacionUsuario
 *
 * @ORM\Table(name="notificacion_usuario", indexes={@ORM\Index(name="fk_not_usuario_idx", columns={"notificacion_id"}), @ORM\Index(name="fk_usuario_not_idx", columns={"usuario_id"})})
 * @ORM\Entity
 */
class NotificacionUsuario
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="notificado", type="boolean", nullable=true)
     */
    private $notificado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime", nullable=true)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \Acme\boletinesBundle\Entity\Notificacion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Notificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notificacion_id", referencedColumnName="id")
     * })
     */
    private $notificacion;



    /**
     * Set notificado
     *
     * @param boolean $notificado
     * @return NotificacionUsuario
     */
    public function setNotificado($notificado)
    {
        $this->notificado = $notificado;

        return $this;
    }

    /**
     * Get notificado
     *
     * @return boolean 
     */
    public function getNotificado()
    {
        return $this->notificado;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return NotificacionUsuario
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return \DateTime 
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return NotificacionUsuario
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set usuario
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuario
     * @return NotificacionUsuario
     */
    public function setUsuario(\Acme\boletinesBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set notificacion
     *
     * @param \Acme\boletinesBundle\Entity\Notificacion $notificacion
     * @return NotificacionUsuario
     */
    public function setNotificacion(\Acme\boletinesBundle\Entity\Notificacion $notificacion = null)
    {
        $this->notificacion = $notificacion;

        return $this;
    }

    /**
     * Get notificacion
     *
     * @return \Acme\boletinesBundle\Entity\Notificacion 
     */
    public function getNotificacion()
    {
        return $this->notificacion;
    }
}
