<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="padre")
 */
class Padre
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string")
     */
    protected $apellido;

    /**
     * @ORM\Column(type="string")
     */
    protected $dni;

    /**
     * @ORM\Column(type="string")
     */
    protected $direccion;

    /**
     * @ORM\Column(type="string")
     */
    protected $telefono;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $ocupacion;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $celular;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $telefono_laboral;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $direccion_laboral;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $observaciones;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Padre
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
     * Set apellido
     *
     * @param string $apellido
     * @return Padre
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Padre
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Padre
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
     * Set telefono
     *
     * @param string $telefono
     * @return Padre
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
     * Set ocupacion
     *
     * @param string $ocupacion
     * @return Padre
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string 
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Padre
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set telefono_laboral
     *
     * @param string $telefonoLaboral
     * @return Padre
     */
    public function setTelefonoLaboral($telefonoLaboral)
    {
        $this->telefono_laboral = $telefonoLaboral;

        return $this;
    }

    /**
     * Get telefono_laboral
     *
     * @return string 
     */
    public function getTelefonoLaboral()
    {
        return $this->telefono_laboral;
    }

    /**
     * Set direccion_laboral
     *
     * @param string $direccionLaboral
     * @return Padre
     */
    public function setDireccionLaboral($direccionLaboral)
    {
        $this->direccion_laboral = $direccionLaboral;

        return $this;
    }

    /**
     * Get direccion_laboral
     *
     * @return string 
     */
    public function getDireccionLaboral()
    {
        return $this->direccion_laboral;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Padre
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
     * Set usuario
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuario
     * @return Padre
     */
    public function setUsuario(\Acme\boletinesBundle\Entity\Usuario $usuario)
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
}
