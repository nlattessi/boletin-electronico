<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Justificacion
 *
 * @ORM\Table(name="justificacion", indexes={@ORM\Index(name="FK_EBF13A877FA0C10D", columns={"usuario_carga_id"}), @ORM\Index(name="FK_EBF13A87EBB41DF2", columns={"archivo_id"})})
 * @ORM\Entity
 */
class Justificacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=250, nullable=false)
     */
    private $comentario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carga", type="datetime", nullable=false)
     */
    private $fechaCarga;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Archivo
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="archivo_id", referencedColumnName="id")
     * })
     */
    //private $archivo;

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
     * @ORM\OneToMany(targetEntity="MensajeArchivo", mappedBy="mensaje")
     */
    private $archivos;


    /* CONSTRUCT */
    public function __construct()
    {
        $this->archivos = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Justificacion
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set fechaCarga
     *
     * @param \DateTime $fechaCarga
     * @return Justificacion
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;

        return $this;
    }

    /**
     * Get fechaCarga
     *
     * @return \DateTime
     */
    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Justificacion
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
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
     * Set archivo
     *
     * @param \Acme\boletinesBundle\Entity\Archivo $archivo
     * @return Justificacion
     */
    // public function setArchivo(\Acme\boletinesBundle\Entity\Archivo $archivo = null)
    // {
    //     $this->archivo = $archivo;
    //
    //     return $this;
    // }

    /**
     * Get archivo
     *
     * @return \Acme\boletinesBundle\Entity\Archivo
     */
    // public function getArchivo()
    // {
    //     return $this->archivo;
    // }

    /**
     * Set usuarioCarga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Justificacion
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

    public function getArchivos()
    {
        return $this->archivos;
    }
}
