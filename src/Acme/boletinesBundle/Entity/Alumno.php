<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", indexes={@ORM\Index(name="FK_usuario_id", columns={"usuario_id"}), @ORM\Index(name="FK_direccion_ciudad_id", columns={"ciudad_id"}), @ORM\Index(name="FK_padre_1_id", columns={"padre1_id"}), @ORM\Index(name="FK_padre_2_id", columns={"padre2_id"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=30, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=8, nullable=false)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=60, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=10, nullable=true)
     */
    private $codigoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_pais", type="string", length=4, nullable=false)
     */
    private $codigoPais;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_area", type="string", length=5, nullable=false)
     */
    private $codigoArea;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=12, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string", length=20, nullable=true)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=true)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="obra_social", type="string", length=20, nullable=false)
     */
    private $obraSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="obra_social_numero_afiliado", type="string", length=20, nullable=false)
     */
    private $obraSocialNumeroAfiliado;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_emergencia", type="string", length=20, nullable=false)
     */
    private $telefonoEmergencia;

    /**
     * @var string
     *
     * @ORM\Column(name="apodo", type="string", length=40, nullable=true)
     */
    private $apodo;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=250, nullable=true)
     */
    private $foto;

    /**
     * @var \Acme\boletinesBundle\Entity\Avatar
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Avatar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     * })
     */
    private $avatar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="especialidad_id", type="integer", nullable=true)
     */
    private $especialidadId;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \Acme\boletinesBundle\Entity\Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="$establecimiento_id", referencedColumnName="id")
     * })
     */
    private $establecimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime", nullable=false)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=false)
     */
    private $updateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo_sanguineo", type="string", length=12, nullable=true)
     */
    private $grupoSanguineo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Padre
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Padre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="padre2_id", referencedColumnName="id")
     * })
     */
    private $padre2;

    /**
     * @var \Acme\boletinesBundle\Entity\Padre
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Padre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="padre1_id", referencedColumnName="id")
     * })
     */
    private $padre1;

    /**
     * @var \Acme\boletinesBundle\Entity\Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     * })
     */
    private $ciudad;

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
     * @ManyToMany(targetEntity="Acme\boletinesBundle\Entity\Materia")
     * @JoinTable(name="alumno_materia",
     *      joinColumns={@JoinColumn(name="alumno_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="materia_id", referencedColumnName="id")}
     *      )
     **/
    private $materias;

    private $grupos;

    public function __construct() {
        $this->materias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getMaterias()
    {
        return $this->materias;
    }

    /**
     * @param mixed $materias
     */
    public function setMaterias($materias)
    {
        $this->materias = $materias;
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
     * Set codigoPostal
     *
     * @param string $codigoPostal
     * @return Alumno
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set codigoPais
     *
     * @param string $codigoPais
     * @return Alumno
     */
    public function setCodigoPais($codigoPais)
    {
        $this->codigoPais = $codigoPais;

        return $this;
    }

    /**
     * Get codigoPais
     *
     * @return string
     */
    public function getCodigoPais()
    {
        return $this->codigoPais;
    }

    /**
     * Set codigoArea
     *
     * @param string $codigoArea
     * @return Alumno
     */
    public function setCodigoArea($codigoArea)
    {
        $this->codigoArea = $codigoArea;

        return $this;
    }

    /**
     * Get codigoArea
     *
     * @return string
     */
    public function getCodigoArea()
    {
        return $this->codigoArea;
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
     * Set obraSocial
     *
     * @param string $obraSocial
     * @return Alumno
     */
    public function setObraSocial($obraSocial)
    {
        $this->obraSocial = $obraSocial;

        return $this;
    }

    /**
     * Get obraSocial
     *
     * @return string
     */
    public function getObraSocial()
    {
        return $this->obraSocial;
    }

    /**
     * Set obraSocialNumeroAfiliado
     *
     * @param string $obraSocialNumeroAfiliado
     * @return Alumno
     */
    public function setObraSocialNumeroAfiliado($obraSocialNumeroAfiliado)
    {
        $this->obraSocialNumeroAfiliado = $obraSocialNumeroAfiliado;

        return $this;
    }

    /**
     * Get obraSocialNumeroAfiliado
     *
     * @return string
     */
    public function getObraSocialNumeroAfiliado()
    {
        return $this->obraSocialNumeroAfiliado;
    }

    /**
     * Set telefonoEmergencia
     *
     * @param string $telefonoEmergencia
     * @return Alumno
     */
    public function setTelefonoEmergencia($telefonoEmergencia)
    {
        $this->telefonoEmergencia = $telefonoEmergencia;

        return $this;
    }

    /**
     * Get telefonoEmergencia
     *
     * @return string
     */
    public function getTelefonoEmergencia()
    {
        return $this->telefonoEmergencia;
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
     * Set avatar
     *
     * @param \Acme\boletinesBundle\Entity\Avatar $avatar
     * @return Alumno
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \Acme\boletinesBundle\Entity\Avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     * @return Alumno
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Alumno
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set especialidadId
     *
     * @param integer $especialidadId
     * @return Alumno
     */
    public function setEspecialidadId($especialidadId)
    {
        $this->especialidadId = $especialidadId;

        return $this;
    }

    /**
     * Get especialidadId
     *
     * @return integer
     */
    public function getEspecialidadId()
    {
        return $this->especialidadId;
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



    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Alumno
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
     * @return Alumno
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
     * Set grupoSanguineo
     *
     * @param string $grupoSanguineo
     * @return Alumno
     */
    public function setGrupoSanguineo($grupoSanguineo)
    {
        $this->grupoSanguineo = $grupoSanguineo;

        return $this;
    }

    /**
     * Get grupoSanguineo
     *
     * @return string
     */
    public function getGrupoSanguineo()
    {
        return $this->grupoSanguineo;
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
     * Set padre2
     *
     * @param \Acme\boletinesBundle\Entity\Padre $padre2
     * @return Alumno
     */
    public function setPadre2(\Acme\boletinesBundle\Entity\Padre $padre2 = null)
    {
        $this->padre2 = $padre2;

        return $this;
    }

    /**
     * Get padre2
     *
     * @return \Acme\boletinesBundle\Entity\Padre
     */
    public function getPadre2()
    {
        return $this->padre2;
    }

    /**
     * Set padre1
     *
     * @param \Acme\boletinesBundle\Entity\Padre $padre1
     * @return Alumno
     */
    public function setPadre1(\Acme\boletinesBundle\Entity\Padre $padre1 = null)
    {
        $this->padre1 = $padre1;

        return $this;
    }

    /**
     * Get padre1
     *
     * @return \Acme\boletinesBundle\Entity\Padre
     */
    public function getPadre1()
    {
        return $this->padre1;
    }

    /**
     * Set ciudad
     *
     * @param \Acme\boletinesBundle\Entity\Ciudad $ciudad
     * @return Alumno
     */
    public function setCiudad(\Acme\boletinesBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \Acme\boletinesBundle\Entity\Ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set usuario
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuario
     * @return Alumno
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
     * @return mixed
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * @param mixed $grupos
     */
    public function setGrupos($grupos)
    {
        $this->grupos = $grupos;
    }



    public function __toString()
    {
        return $this->getApellido() .', '. $this->getNombre();
    }

    public function getFotoAbsolutePath()
    {
        return null === $this->getFoto()
            ? null
            : $this->getUploadRootDir() . '/' . $this->getFoto();
    }
    public function getFotoWebPath()
    {
        return null === $this->getFoto()
            ? null
            : $this->getUploadDir() . '/' . $this->getFoto();
    }
    private function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }
    private function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'bundles/boletines/uploads/portraits/alumnos';
    }

    /**
     * Add materias
     *
     * @param \Acme\boletinesBundle\Entity\AlumnoMateria $materias
     * @return Alumno
     */
    public function addMateria(\Acme\boletinesBundle\Entity\AlumnoMateria $materias)
    {
        $this->materias[] = $materias;

        return $this;
    }

    /**
     * Remove materias
     *
     * @param \Acme\boletinesBundle\Entity\AlumnoMateria $materias
     */
    public function removeMateria(\Acme\boletinesBundle\Entity\AlumnoMateria $materias)
    {
        $this->materias->removeElement($materias);
    }

    /**
     * Add grupos
     *
     * @param \Acme\boletinesBundle\Entity\GrupoAlumno $grupos
     * @return Alumno
     */
    public function addGrupo(\Acme\boletinesBundle\Entity\GrupoAlumno $grupos)
    {
        $this->grupos[] = $grupos;

        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \Acme\boletinesBundle\Entity\GrupoAlumno $grupos
     */
    public function removeGrupo(\Acme\boletinesBundle\Entity\GrupoAlumno $grupos)
    {
        $this->grupos->removeElement($grupos);
    }
}
