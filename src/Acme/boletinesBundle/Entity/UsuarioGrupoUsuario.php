<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioGrupoUsuario
 *
 * @ORM\Table(name="usuario_grupo_usuario", indexes={@ORM\Index(name="IDX_8BDF2024FCF8192D", columns={"usuario_id"}), @ORM\Index(name="IDX_8BDF2024C344EF9F", columns={"grupo_usuario_id"})})
 * @ORM\Entity
 */
class UsuarioGrupoUsuario
{
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
     * @var \Acme\boletinesBundle\Entity\GrupoUsuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_usuario_id", referencedColumnName="id")
     * })
     */
    private $grupoUsuario;



    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return UsuarioGrupoUsuario
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
     * @return UsuarioGrupoUsuario
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
     * @return UsuarioGrupoUsuario
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
     * Set grupoUsuario
     *
     * @param \Acme\boletinesBundle\Entity\GrupoUsuario $grupoUsuario
     * @return UsuarioGrupoUsuario
     */
    public function setGrupoUsuario(\Acme\boletinesBundle\Entity\GrupoUsuario $grupoUsuario = null)
    {
        $this->grupoUsuario = $grupoUsuario;

        return $this;
    }

    /**
     * Get grupoUsuario
     *
     * @return \Acme\boletinesBundle\Entity\GrupoUsuario 
     */
    public function getGrupoUsuario()
    {
        return $this->grupoUsuario;
    }
}
