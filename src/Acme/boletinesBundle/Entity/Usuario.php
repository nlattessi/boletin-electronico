<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_usuario", type="string", length=45, nullable=false)
     */
    private $nombreUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_usuario_para_mostrar", type="string", length=45, nullable=false)
     */
    private $nombreUsuarioParaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_real", type="string", length=45, nullable=true)
     */
    private $nombreReal;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_usuario", type="string", length=15, nullable=true)
     */
    private $telefonoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuario;

    /**
     * @var \Acme\boletinesBundle\Entity\Rol
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rol", referencedColumnName="id_rol")
     * })
     */
    private $idRol;

	public function getNombreUsuario(){
		return $this->nombreUsuario;
	}

	public function setNombreUsuario($nombreUsuario){
		$this->nombreUsuario = $nombreUsuario;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getNombreUsuarioParaMostrar(){
		return $this->nombreUsuarioParaMostrar;
	}

	public function setNombreUsuarioParaMostrar($nombreUsuarioParaMostrar){
		$this->nombreUsuarioParaMostrar = $nombreUsuarioParaMostrar;
	}

	public function getNombreReal(){
		return $this->nombreReal;
	}

	public function setNombreReal($nombreReal){
		$this->nombreReal = $nombreReal;
	}

	public function getTelefonoUsuario(){
		return $this->telefonoUsuario;
	}

	public function setTelefonoUsuario($telefonoUsuario){
		$this->telefonoUsuario = $telefonoUsuario;
	}

	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getId(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

    public function __toString(){
        return $this->getNombreUsuarioParaMostrar();
    }

    public function getRoles(){
        return array($this->idRol->getNombreRol());
//        return array('ROLE_ADMIN');
    }

    public function getSalt(){
        return '';
    }

    public function getUsername(){
        return $this->nombreUsuario;
    }
    public function eraseCredentials(){}

    /**
     * @see \Serializable::serialize()
     */
    public function serialize(){
        return serialize(array(
            $this->idUsuario,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized){
        list (
            $this->idUsuario,
            ) = unserialize($serialized);
    }

    /**
     * @return Rol
     */
    public function getRol()
    {
        return $this->idRol;
    }

    /**
     * @param Rol $idRol
     */
    public function setRol($idRol)
    {
        $this->idRol = $idRol;
    }

    /**
     * Set idRol
     *
     * @param \Acme\boletinesBundle\Entity\Rol $idRol
     * @return Usuario
     */
    public function setIdRol(\Acme\boletinesBundle\Entity\Rol $idRol = null)
    {
        $this->idRol = $idRol;

        return $this;
    }

    /**
     * Get idRol
     *
     * @return \Acme\boletinesBundle\Entity\Rol 
     */
    public function getIdRol()
    {
        return $this->idRol;
    }
}
