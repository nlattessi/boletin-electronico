<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="archivo")
 */
class Archivo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre_para_mostrar;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string")
     */
    protected $ruta;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_carga_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario_carga;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_carga;

    public function __construct()
    {
        $this->fecha_carga = new \DateTime();
    }

    public function __toString()
    {
        return $this->getNombre();
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
     * Set nombre_para_mostrar
     *
     * @param string $nombreParaMostrar
     * @return Archivo
     */
    public function setNombreParaMostrar($nombreParaMostrar)
    {
        $this->nombre_para_mostrar = $nombreParaMostrar;

        return $this;
    }

    /**
     * Get nombre_para_mostrar
     *
     * @return string 
     */
    public function getNombreParaMostrar()
    {
        return $this->nombre_para_mostrar;
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
     * Set ruta
     *
     * @param string $ruta
     * @return Archivo
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set fecha_carga
     *
     * @param \DateTime $fechaCarga
     * @return Archivo
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fecha_carga = $fechaCarga;

        return $this;
    }

    /**
     * Get fecha_carga
     *
     * @return \DateTime 
     */
    public function getFechaCarga()
    {
        return $this->fecha_carga;
    }

    /**
     * Set usuario_carga
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioCarga
     * @return Archivo
     */
    public function setUsuarioCarga(\Acme\boletinesBundle\Entity\Usuario $usuarioCarga)
    {
        $this->usuario_carga = $usuarioCarga;

        return $this;
    }

    /**
     * Get usuario_carga
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuarioCarga()
    {
        return $this->usuario_carga;
    }
}
