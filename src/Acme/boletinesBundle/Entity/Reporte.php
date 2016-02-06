<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reporte
 */
class Reporte
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $dql;

    /**
     * @var \DateTime
     */
    private $creationTime;

    /**
     * @var \DateTime
     */
    private $updateTime;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Rol
     */
    private $rol;

    /**
     * @var \Acme\boletinesBundle\Entity\Institucion
     */
    private $institucion;

    function __construct($nombre, $dql, $rol, $institucion)
    {
        $this->setNombre($nombre);
        $this->setDql($dql);
        $this->setRol($rol);
        $this->setInstitucion($institucion);
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Reporte
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
     * Set dql
     *
     * @param string $dql
     * @return Reporte
     */
    public function setDql($dql)
    {
        $this->dql = $dql;

        return $this;
    }

    /**
     * Get dql
     *
     * @return string 
     */
    public function getDql()
    {
        return $this->dql;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Reporte
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
     * @return Reporte
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
     * Set rol
     *
     * @param \Acme\boletinesBundle\Entity\Rol $rol
     * @return Reporte
     */
    public function setRol(\Acme\boletinesBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \Acme\boletinesBundle\Entity\Rol 
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set institucion
     *
     * @param \Acme\boletinesBundle\Entity\Institucion $institucion
     * @return Reporte
     */
    public function setInstitucion(\Acme\boletinesBundle\Entity\Institucion $institucion = null)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return \Acme\boletinesBundle\Entity\Institucion 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }
}
