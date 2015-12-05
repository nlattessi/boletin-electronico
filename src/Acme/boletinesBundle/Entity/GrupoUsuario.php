<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoUsuario
 *
 * @ORM\Table(name="grupo_usuario", indexes={@ORM\Index(name="FK_7D6C3EFA7FA0C10D", columns={"usuario_carga_id"})})
 * @ORM\Entity
 */
class GrupoUsuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_privado", type="boolean", nullable=false)
     */
    private $esPrivado;

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
     *   @ORM\JoinColumn(name="usuario_carga_id", referencedColumnName="id")
     * })
     */
    private $usuarioCarga;

    /**
     * @var \Acme\boletinesBundle\Entity\Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id")
     * })
     */
    private $establecimiento;

    private $usuarios;

    private $cantUsuarios;


    /* CONSTRUCT */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * @param mixed $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @return mixed
     */
    public function getCantUsuarios()
    {
        return $this->cantUsuarios;
    }

    /**
     * @param mixed $cantUsuarios
     */
    public function setCantUsuarios($cantUsuarios)
    {
        $this->cantUsuarios = $cantUsuarios;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return GrupoUsuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set esPrivado
     *
     * @param boolean $esPrivado
     * @return GrupoUsuario
     */
    public function setEsPrivado($esPrivado)
    {
        $this->esPrivado = $esPrivado;

        return $this;
    }

    /**
     * Get esPrivado
     *
     * @return boolean 
     */
    public function getEsPrivado()
    {
        return $this->esPrivado;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return GrupoUsuario
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
     * @return GrupoUsuario
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
     * Set usuarioCarga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return GrupoUsuario
     */
    public function setUsuarioCarga(\Acme\boletinesBundle\Entity\Usuario $usuarioCarga = null)
    {
        $this->usuarioCarga = $usuarioCarga;

        return $this;
    }

    /**
     * Get usuarioCarga
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuarioCarga()
    {
        return $this->usuarioCarga;
    }

    /**
     * @return Establecimiento
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * @param Establecimiento $establecimiento
     */
    public function setEstablecimiento($establecimiento)
    {
        $this->establecimiento = $establecimiento;
    }


}
