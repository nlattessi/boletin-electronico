<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValorCalificacion
 */
class ValorCalificacion
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $valor;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\EsquemaCalificacion
     */
    private $esquemaCalificacion;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return ValorCalificacion
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
     * Set valor
     *
     * @param integer $valor
     * @return ValorCalificacion
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer 
     */
    public function getValor()
    {
        return $this->valor;
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
     * Set esquemaCalificacion
     *
     * @param \Acme\boletinesBundle\Entity\EsquemaCalificacion $esquemaCalificacion
     * @return ValorCalificacion
     */
    public function setEsquemaCalificacion(\Acme\boletinesBundle\Entity\EsquemaCalificacion $esquemaCalificacion = null)
    {
        $this->esquemaCalificacion = $esquemaCalificacion;

        return $this;
    }

    /**
     * Get esquemaCalificacion
     *
     * @return \Acme\boletinesBundle\Entity\EsquemaCalificacion 
     */
    public function getEsquemaCalificacion()
    {
        return $this->esquemaCalificacion;
    }

    public function __toString(){
        return $this->getNombre();
    }
}
