<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="materia")
 */
class Materia
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
    protected $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="TipoMateria")
     * @ORM\JoinColumn(name="tipo_materia_id", referencedColumnName="id", nullable=false)
     */
    protected $tipo_materia;

    /**
     * @ORM\ManyToOne(targetEntity="Calendario")
     * @ORM\JoinColumn(name="calendario_id", referencedColumnName="id", nullable=false)
     */
    protected $calendario;

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
     * @return Materia
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
     * Set tipo_materia
     *
     * @param \Acme\boletinesBundle\Entity\TipoMateria $tipoMateria
     * @return Materia
     */
    public function setTipoMateria(\Acme\boletinesBundle\Entity\TipoMateria $tipoMateria)
    {
        $this->tipo_materia = $tipoMateria;

        return $this;
    }

    /**
     * Get tipo_materia
     *
     * @return \Acme\boletinesBundle\Entity\TipoMateria 
     */
    public function getTipoMateria()
    {
        return $this->tipo_materia;
    }

    /**
     * Set calendario
     *
     * @param \Acme\boletinesBundle\Entity\Calendario $calendario
     * @return Materia
     */
    public function setCalendario(\Acme\boletinesBundle\Entity\Calendario $calendario)
    {
        $this->calendario = $calendario;

        return $this;
    }

    /**
     * Get calendario
     *
     * @return \Acme\boletinesBundle\Entity\Calendario 
     */
    public function getCalendario()
    {
        return $this->calendario;
    }
}
