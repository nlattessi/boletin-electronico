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
     * @var \Acme\boletinesBundle\Entity\EsquemaEvaluacion
     */
    private $esquemaEvaluacion;


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
     * Set esquemaEvaluacion
     *
     * @param \Acme\boletinesBundle\Entity\EsquemaEvaluacion $esquemaEvaluacion
     * @return ValorCalificacion
     */
    public function setEsquemaEvaluacion(\Acme\boletinesBundle\Entity\EsquemaEvaluacion $esquemaEvaluacion = null)
    {
        $this->esquemaEvaluacion = $esquemaEvaluacion;

        return $this;
    }

    /**
     * Get esquemaEvaluacion
     *
     * @return \Acme\boletinesBundle\Entity\EsquemaEvaluacion 
     */
    public function getEsquemaEvaluacion()
    {
        return $this->esquemaEvaluacion;
    }
}
