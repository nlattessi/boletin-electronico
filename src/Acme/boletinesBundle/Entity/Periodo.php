<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periodo
 */
class Periodo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $establecimiento;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \DateTime
     */
    private $fechaDesde;

    /**
     * @var \DateTime
     */
    private $fechaHasta;

    /**
     * @var \DateTime
     */
    private $creationTime;

    /**
     * @var \DateTime
     */
    private $updateTime;

    private $evaluaciones;

    private $anioLectivo;

    public function __construct()
    {
        $this->creationTime = new \DateTime();
        $this->updateTime = new \DateTime();
        $this->evaluaciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set establecimientoId
     *
     * @param integer $establecimientoId
     * @return Periodo
     */
    public function setEstablecimiento(Establecimiento $establecimiento)
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimientoId
     *
     * @return integer
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Periodo
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
     * Set fechaDesde
     *
     * @param \DateTime $fechaDesde
     * @return Periodo
     */
    public function setFechaDesde($fechaDesde)
    {
        $this->fechaDesde = $fechaDesde;

        return $this;
    }

    /**
     * Get fechaDesde
     *
     * @return \DateTime
     */
    public function getFechaDesde()
    {
        return $this->fechaDesde;
    }

    /**
     * Set fechaHasta
     *
     * @param \DateTime $fechaHasta
     * @return Periodo
     */
    public function setFechaHasta($fechaHasta)
    {
        $this->fechaHasta = $fechaHasta;

        return $this;
    }

    /**
     * Get fechaHasta
     *
     * @return \DateTime
     */
    public function getFechaHasta()
    {
        return $this->fechaHasta;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Periodo
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
     * @return Periodo
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

    public function getEvaluaciones()
    {
        return $this->evaluaciones;
    }

    public function setAnioLectivo($anioLectivo)
    {
        $this->anioLectivo = $anioLectivo;

        return $this;
    }

    public function getAnioLectivo()
    {
        return $this->anioLectivo;
    }

    public function __toString(){
        return $this->getNombre();
    }
}
