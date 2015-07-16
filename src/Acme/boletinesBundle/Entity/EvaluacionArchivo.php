<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluacionArchivo
 *
 * @ORM\Table(name="evaluacion_archivo", indexes={@ORM\Index(name="FK_96A9D3A6EBB41DF2", columns={"archivo_id"}), @ORM\Index(name="FK_96A9D3A6777B3A01", columns={"evaluacion_id"})})
 * @ORM\Entity
 */
class EvaluacionArchivo
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
     * @var \Acme\boletinesBundle\Entity\Evaluacion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Evaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evaluacion_id", referencedColumnName="id")
     * })
     */
    private $evaluacion;



    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return EvaluacionArchivo
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
     * @return EvaluacionArchivo
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
     * @return EvaluacionArchivo
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
     * Set evaluacion
     *
     * @param \Acme\boletinesBundle\Entity\Evaluacion $evaluacion
     * @return EvaluacionArchivo
     */
    public function setEvaluacion(\Acme\boletinesBundle\Entity\Evaluacion $evaluacion = null)
    {
        $this->evaluacion = $evaluacion;

        return $this;
    }

    /**
     * Get evaluacion
     *
     * @return \Acme\boletinesBundle\Entity\Evaluacion 
     */
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }
}
