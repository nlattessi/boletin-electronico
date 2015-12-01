<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="FK_2265B05D90F1D76D", columns={"rol_id"})})
 * @ORM\Entity
 */
class Usuario implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_entidad_asociada", type="integer", nullable=true)
     */
    private $idEntidadAsociada;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=65, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=65, nullable=true)
     */
    private $apellido;

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
     * @var \Acme\boletinesBundle\Entity\Rol
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     * })
     */
    private $rol;

    /**
     * @var \Acme\boletinesBundle\Entity\Institucion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Institucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="institucion_id", referencedColumnName="id")
     * })
     */
    private $institucion;

    private $actividades;

    /**
     * @ORM\OneToMany(targetEntity="MensajeUsuario", mappedBy="usuario")
     */
    protected $mensajes;

    /**
     * @ORM\OneToMany(targetEntity="NotificacionUsuario", mappedBy="usuario")
     */
    protected $notificaciones;


    /* CONSTRUCT */
    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mensajes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set idEntidadAsociada
     *
     * @param integer $idEntidadAsociada
     * @return Usuario
     */
    public function setIdEntidadAsociada($idEntidadAsociada)
    {
        $this->idEntidadAsociada = $idEntidadAsociada;

        return $this;
    }

    /**
     * Get idEntidadAsociada
     *
     * @return integer
     */
    public function getIdEntidadAsociada()
    {
        return $this->idEntidadAsociada;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
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
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Usuario
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
     * @return Usuario
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
     * Set rol
     *
     * @param \Acme\boletinesBundle\Entity\Rol $rol
     * @return Usuario
     */
    public function setRol(\Acme\boletinesBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \Acme\boletinesBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set institucion
     *
     * @param \Acme\boletinesBundle\Entity\Institucion $institucion
     * @return Usuario
     */
    public function setInstitucion(\Acme\boletinesBundle\Entity\Institucion $institucion = null)
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


    public function getUsername()
    {
        return $this->nombre;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        $roles = array();
        $roles[] = $this->getRol()->getNombre();
        return $roles;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->nombre,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nombre,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    public function getActividades()
    {
        return $this->actividades;
    }

    public function addActividad(\Acme\boletinesBundle\Entity\Actividad $actividad = null)
    {
        if (! $this->actividades->contains($actividad)) {
            $this->actividades->add($actividad);
        }

        return $this;
    }

    public function removeActividad(\Acme\boletinesBundle\Entity\Actividad $actividad = null)
    {
        if ($this->actividades->contains($actividad)) {
            $this->actividades->removeElement($actividad);
        }

        return $this;
    }

    public function esPadre(Usuario $usuario) {
        return $usuario->getRol()->getNombre() == 'ROLE_PADRE';
    }

    /**
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getNombreCompleto()
    {
        return $this->getNombre() . ' ' . $this->getApellido();
    }

    public function getMensajes()
    {
        return $this->mensajes;
    }

    public function getMensajesNoLeidos()
    {
        return $this->mensajes->filter(function($mensaje) {
            return ($mensaje->getLeido() == false
                && $mensaje->getBorrado() == false
                && $mensaje->getBorrador() == false
            );
        });
    }

    public function getNotificaciones()
    {
        return $this->notificaciones;
    }

    public function getNotificacionesNoVistas()
    {
        return $this->notificaciones->filter(function($notificacion) {
            return $notificacion->getNotificado() == false;
        });
    }
}
