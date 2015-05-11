<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materia
 *
 * @ORM\Table(name="materia", indexes={@ORM\Index(name="calendario_fk_materia", columns={"id_calendario_materia"}), @ORM\Index(name="tipo_materia_fk_materia", columns={"id_tipo_materia"})})
 * @ORM\Entity
 */
class Materia
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_materia", type="string", length=45, nullable=false)
     */
    private $nombreMateria;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_materia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMateria;

    /**
     * @var \Acme\boletinesBundle\Entity\TipoMateria
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\TipoMateria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_materia", referencedColumnName="id_tipo_materia")
     * })
     */
    private $idTipoMateria;

    /**
     * @var \Acme\boletinesBundle\Entity\Calendario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Calendario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_calendario_materia", referencedColumnName="id_calendario")
     * })
     */
    private $idCalendarioMateria;

	public function getNombreMateria(){
		return $this->nombreMateria;
	}

	public function setNombreMateria($nombreMateria){
		$this->nombreMateria = $nombreMateria;
	}

	public function getIdMateria(){
		return $this->idMateria;
	}
	public function getId(){
		return $this->idMateria;
	}

	public function setIdMateria($idMateria){
		$this->idMateria = $idMateria;
	}

	public function getIdTipoMateria(){
		return $this->idTipoMateria;
	}

	public function setIdTipoMateria($idTipoMateria){
		$this->idTipoMateria = $idTipoMateria;
	}

	public function getIdCalendarioMateria(){
		return $this->idCalendarioMateria;
	}

	public function setIdCalendarioMateria($idCalendarioMateria){
		$this->idCalendarioMateria = $idCalendarioMateria;
	}
    public function _toString() {
     return $this->nombreMateria;  
   } 
}
