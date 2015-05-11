<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
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

}
