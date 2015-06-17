<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="establecimiento")
 */
class Establecimiento
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Institucion")
     * @ORM\JoinColumn(name="institucion_id", referencedColumnName="id", nullable=false)
     */
    protected $institucion;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string")
     */
    protected $direccion;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $coordenadas_mapa;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha_inauguracion;

    /**
     * @ORM\Column(type="string")
     */
    protected $telefono;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $observaciones;

    public function __toString(){
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
     * Set nombre
     *
     * @param string $nombre
     * @return Establecimiento
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
     * Set direccion
     *
     * @param string $direccion
     * @return Establecimiento
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set coordenadas_mapa
     *
     * @param string $coordenadasMapa
     * @return Establecimiento
     */
    public function setCoordenadasMapa($coordenadasMapa)
    {
        $this->coordenadas_mapa = $coordenadasMapa;

        return $this;
    }

    /**
     * Get coordenadas_mapa
     *
     * @return string 
     */
    public function getCoordenadasMapa()
    {
        return $this->coordenadas_mapa;
    }

    /**
     * Set fecha_inauguracion
     *
     * @param \DateTime $fechaInauguracion
     * @return Establecimiento
     */
    public function setFechaInauguracion($fechaInauguracion)
    {
        $this->fecha_inauguracion = $fechaInauguracion;

        return $this;
    }

    /**
     * Get fecha_inauguracion
     *
     * @return \DateTime 
     */
    public function getFechaInauguracion()
    {
        return $this->fecha_inauguracion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Establecimiento
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Establecimiento
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Establecimiento
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set institucion
     *
     * @param \Acme\boletinesBundle\Entity\Institucion $institucion
     * @return Establecimiento
     */
    public function setInstitucion(\Acme\boletinesBundle\Entity\Institucion $institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return \Acme\boletinesBundle\Entity\Institucion 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }
}
