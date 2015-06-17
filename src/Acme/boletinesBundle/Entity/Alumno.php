<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="alumno")
 */
class Alumno
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
    protected $nacionalidad;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    protected $sexo;

    /**
     * @ORM\ManyToOne(targetEntity="Padre")
     * @ORM\JoinColumn(name="padre_1_id", referencedColumnName="id", nullable=false)
     */
    protected $padre_1;

    /**
     * @ORM\ManyToOne(targetEntity="Padre")
     * @ORM\JoinColumn(name="padre_2_id", referencedColumnName="id", nullable=false)
     */
    protected $padre_2;

    /**
     * @ORM\Column(type="string")
     */
    protected $obra_social;

    /**
     * @ORM\Column(type="string")
     */
    protected $telefono_emergencia;

    /**
     * @ORM\Column(type="string")
     */
    protected $obra_social_numero_afiliado;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $apodo;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $foto;

    /**
     * @ORM\Column(type="date")
     */
    protected $fecha_ingreso;

    /**
     * @ORM\Column(type="date")
     */
    protected $fecha_nacimiento;

    /**
     * @ORM\ManyToOne(targetEntity="Especialidad")
     * @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id", nullable=true)
     */
    protected $especialidad;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Establecimiento")
     * @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id", nullable=false)
     */
    protected $establecimiento;

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
     * @return Alumno
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
     * @return Alumno
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
     * @return Alumno
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
     * @return Alumno
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
     * @return Alumno
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
     * Set nacionalidad
     *
     * @param string $nacionalidad
     * @return Alumno
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string 
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Alumno
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set obra_social
     *
     * @param string $obraSocial
     * @return Alumno
     */
    public function setObraSocial($obraSocial)
    {
        $this->obra_social = $obraSocial;

        return $this;
    }

    /**
     * Get obra_social
     *
     * @return string 
     */
    public function getObraSocial()
    {
        return $this->obra_social;
    }

    /**
     * Set telefono_emergencia
     *
     * @param string $telefonoEmergencia
     * @return Alumno
     */
    public function setTelefonoEmergencia($telefonoEmergencia)
    {
        $this->telefono_emergencia = $telefonoEmergencia;

        return $this;
    }

    /**
     * Get telefono_emergencia
     *
     * @return string 
     */
    public function getTelefonoEmergencia()
    {
        return $this->telefono_emergencia;
    }

    /**
     * Set obra_social_numero_afiliado
     *
     * @param string $obraSocialNumeroAfiliado
     * @return Alumno
     */
    public function setObraSocialNumeroAfiliado($obraSocialNumeroAfiliado)
    {
        $this->obra_social_numero_afiliado = $obraSocialNumeroAfiliado;

        return $this;
    }

    /**
     * Get obra_social_numero_afiliado
     *
     * @return string 
     */
    public function getObraSocialNumeroAfiliado()
    {
        return $this->obra_social_numero_afiliado;
    }

    /**
     * Set apodo
     *
     * @param string $apodo
     * @return Alumno
     */
    public function setApodo($apodo)
    {
        $this->apodo = $apodo;

        return $this;
    }

    /**
     * Get apodo
     *
     * @return string 
     */
    public function getApodo()
    {
        return $this->apodo;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Alumno
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set fecha_ingreso
     *
     * @param \DateTime $fechaIngreso
     * @return Alumno
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fecha_ingreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fecha_ingreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    /**
     * Set fecha_nacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Alumno
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fecha_nacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Alumno
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
     * @return Alumno
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

    /**
     * Set padre_1
     *
     * @param \Acme\boletinesBundle\Entity\Padre $padre1
     * @return Alumno
     */
    public function setPadre1(\Acme\boletinesBundle\Entity\Padre $padre1)
    {
        $this->padre_1 = $padre1;

        return $this;
    }

    /**
     * Get padre_1
     *
     * @return \Acme\boletinesBundle\Entity\Padre 
     */
    public function getPadre1()
    {
        return $this->padre_1;
    }

    /**
     * Set padre_2
     *
     * @param \Acme\boletinesBundle\Entity\Padre $padre2
     * @return Alumno
     */
    public function setPadre2(\Acme\boletinesBundle\Entity\Padre $padre2)
    {
        $this->padre_2 = $padre2;

        return $this;
    }

    /**
     * Get padre_2
     *
     * @return \Acme\boletinesBundle\Entity\Padre 
     */
    public function getPadre2()
    {
        return $this->padre_2;
    }

    /**
     * Set especialidad
     *
     * @param \Acme\boletinesBundle\Entity\Especialidad $especialidad
     * @return Alumno
     */
    public function setEspecialidad(\Acme\boletinesBundle\Entity\Especialidad $especialidad = null)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad
     *
     * @return \Acme\boletinesBundle\Entity\Especialidad 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set establecimiento
     *
     * @param \Acme\boletinesBundle\Entity\Establecimiento $establecimiento
     * @return Alumno
     */
    public function setEstablecimiento(\Acme\boletinesBundle\Entity\Establecimiento $establecimiento)
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return \Acme\boletinesBundle\Entity\Establecimiento 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }
}
