<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Acme\boletinesBundle\Utils\Herramientas;

/**
 * Archivo
 *
 * @ORM\Table(name="archivo", indexes={@ORM\Index(name="FK_3529B4827FA0C10D", columns={"usuario_carga_id"})})
 * @ORM\Entity
 */
class Archivo
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_para_mostrar", type="string", length=45, nullable=false)
     */
    private $nombreParaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=75, nullable=false)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_subida", type="datetime", nullable=false)
     */
    private $fechaSubida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false)
     */
    private $fechaActualizacion;

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

    private $fileSize;



    /**
     * Set nombreParaMostrar
     *
     * @param string $nombreParaMostrar
     * @return Archivo
     */
    public function setNombreParaMostrar($nombreParaMostrar)
    {
        $this->nombreParaMostrar = $nombreParaMostrar;

        return $this;
    }

    /**
     * Get nombreParaMostrar
     *
     * @return string
     */
    public function getNombreParaMostrar()
    {
        return $this->nombreParaMostrar;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Archivo
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
     * Set path
     *
     * @param string $path
     * @return Archivo
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set fechaSubida
     *
     * @param \DateTime $fechaSubida
     * @return Archivo
     */
    public function setFechaSubida($fechaSubida)
    {
        $this->fechaSubida = $fechaSubida;

        return $this;
    }

    /**
     * Get fechaSubida
     *
     * @return \DateTime
     */
    public function getFechaSubida()
    {
        return $this->fechaSubida;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Archivo
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
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
     * @return Archivo
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

    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }

    public function __toString(){
        return $this->getNombreParaMostrar();
    }

    public function getAbsolutePath()
    {
        return null === $this->getPath()
            ? null
            : $this->getUploadRootDir() . '/' . $this->getPath();
    }
    public function getWebPath()
    {
        return null === $this->getPath()
            ? null
            : $this->getUploadDir() . '/' . $this->getPath();
    }
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../app/data/' . $this->getUploadDir();
    }
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'bundles/boletines/uploads/archivos';
    }

    public function getSize()
    {
        return Herramientas::formatSizeUnits(filesize($this->getAbsolutePath()));
    }

    public function getFileName()
    {
        return substr(substr($this->getPath(), strpos($this->getPath(), '/')), 1);
    }
}
