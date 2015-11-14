<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EsquemaCalificacion
 */
class EsquemaCalificacion
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return EsquemaCalificacion
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
