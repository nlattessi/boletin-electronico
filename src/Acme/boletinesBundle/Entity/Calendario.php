<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendario
 *
 * @ORM\Table(name="calendario", indexes={@ORM\Index(name="usuario_fk_calendario", columns={"id_usuario_propietario"})})
 * @ORM\Entity
 */
class Calendario
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_calendario", type="string", length=45, nullable=false)
     */
    private $nombreCalendario;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_calendario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCalendario;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_propietario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioPropietario;

public function getNombreCalendario(){
		return $this->nombreCalendario;
	}

	public function setNombreCalendario($nombreCalendario){
		$this->nombreCalendario = $nombreCalendario;
	}

	public function getId(){
		return $this->idCalendario;
	}
	public function getIdCalendario(){
		return $this->idCalendario;
	}
	
	public function setIdCalendario($idCalendario){
		$this->idCalendario = $idCalendario;
	}

	public function getIdUsuarioPropietario(){
		return $this->idUsuarioPropietario;
	}

	public function setIdUsuarioPropietario($idUsuarioPropietario){
		$this->idUsuarioPropietario = $idUsuarioPropietario;
	}

	public function __toString() {  
     return $this->nombreCalendario;  
   } 
}
