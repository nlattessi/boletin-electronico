<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoMateria
 *
 * @ORM\Table(name="tipo_materia")
 * @ORM\Entity
 */
class TipoMateria
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tipo_materia", type="string", length=45, nullable=false)
     */
    private $nombreTipoMateria;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_materia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoMateria;

    /**
     * @return string
     */
    public function getNombreTipoMateria()
    {
        return $this->nombreTipoMateria;
    }

    /**
     * @param string $nombreTipoMateria
     */
    public function setNombreTipoMateria($nombreTipoMateria)
    {
        $this->nombreTipoMateria = $nombreTipoMateria;
    }

    /**
     * @return int
     */
    public function getIdTipoMateria()
    {
        return $this->idTipoMateria;
    }

    /**
     * @param int $idTipoMateria
     */
    public function setIdTipoMateria($idTipoMateria)
    {
        $this->idTipoMateria = $idTipoMateria;
    }



    public function __toString() {
        return $this->nombreTipoMateria;
   } 

}
