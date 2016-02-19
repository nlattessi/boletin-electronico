<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensaje
 *
 * @ORM\Table(name="mensaje", indexes={@ORM\Index(name="FK_9B631D0165089FEB", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Mensaje
{
    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="string", length=500, nullable=false)
     */
    private $texto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_envio", type="datetime", nullable=false)
     */
    private $fechaEnvio;

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
     * @var boolean
     *
     * @ORM\Column(name="borrador", type="boolean", nullable=true)
     */
    private $borrador;

    /**
     * @ORM\OneToMany(targetEntity="MensajeArchivo", mappedBy="mensaje")
     */
    private $archivos;


    /* CONSTRUCT */
    public function __construct()
    {
        $this->archivos = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Mensaje
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Mensaje
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set fechaEnvio
     *
     * @param \DateTime $fechaEnvio
     * @return Mensaje
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fechaEnvio = $fechaEnvio;

        return $this;
    }

    /**
     * Get fechaEnvio
     *
     * @return \DateTime
     */
    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
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
     * @return Mensaje
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
     * Set borrador
     *
     * @param boolean $borrador
     * @return MensajeUsuario
     */
    public function setBorrador($borrador)
    {
        $this->borrador = $borrador;

        return $this;
    }

    /**
     * Get borrador
     *
     * @return boolean
     */
    public function getBorrador()
    {
        return $this->borrador;
    }

    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * Add archivos
     *
     * @param \Acme\boletinesBundle\Entity\MensajeArchivo $archivos
     * @return Mensaje
     */
    public function addArchivo(\Acme\boletinesBundle\Entity\MensajeArchivo $archivos)
    {
        $this->archivos[] = $archivos;

        return $this;
    }

    /**
     * Remove archivos
     *
     * @param \Acme\boletinesBundle\Entity\MensajeArchivo $archivos
     */
    public function removeArchivo(\Acme\boletinesBundle\Entity\MensajeArchivo $archivos)
    {
        $this->archivos->removeElement($archivos);
    }
}
