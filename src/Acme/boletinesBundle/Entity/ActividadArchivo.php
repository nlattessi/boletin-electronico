<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActividadArchivo
 *
 * @ORM\Table(name="actividad_archivo", indexes={@ORM\Index(name="FK_566A8CA4B36DFBF4", columns={"materia_id"}), @ORM\Index(name="FK_566A8CA4EBB41DF2", columns={"archivo_id"})})
 * @ORM\Entity
 */
class ActividadArchivo
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime", nullable=true)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Archivo
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="archivo_id", referencedColumnName="id")
     * })
     */
    private $archivo;

    /**
     * @var \Acme\boletinesBundle\Entity\Actividad
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Actividad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actividad_id", referencedColumnName="id")
     * })
     */
    private $actividad;



    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return MateriaArchivo
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
     * @return MateriaArchivo
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
     * Set archivo
     *
     * @param \Acme\boletinesBundle\Entity\Archivo $archivo
     * @return MateriaArchivo
     */
    public function setArchivo(\Acme\boletinesBundle\Entity\Archivo $archivo = null)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return \Acme\boletinesBundle\Entity\Archivo
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Actividad $actividad
     * @return ActividadArchivo
     */
    public function setActividad(\Acme\boletinesBundle\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return \Acme\boletinesBundle\Entity\Actividad
     */
    public function getActividad()
    {
        return $this->actividad;
    }

}
