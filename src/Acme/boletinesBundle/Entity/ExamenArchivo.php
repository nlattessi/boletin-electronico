<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExamenArchivo
 *
 * @ORM\Table(name="examen_archivo", indexes={@ORM\Index(name="examen_fk_archivo", columns={"id_examen"}), @ORM\Index(name="archivo_fk_examen", columns={"id_archivo"})})
 * @ORM\Entity
 */
class ExamenArchivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_examen_archivo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExamenArchivo;

    /**
     * @var \Acme\boletinesBundle\Entity\Examen
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Examen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_examen", referencedColumnName="id_examen")
     * })
     */
    private $idExamen;

    /**
     * @var \Acme\boletinesBundle\Entity\Archivo
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_archivo", referencedColumnName="id_archivo")
     * })
     */
    private $idArchivo;



    /**
     * Get idExamenArchivo
     *
     * @return integer 
     */
    public function getIdExamenArchivo()
    {
        return $this->idExamenArchivo;
    }

    /**
     * Set idExamen
     *
     * @param \Acme\boletinesBundle\Entity\Examen $idExamen
     * @return ExamenArchivo
     */
    public function setIdExamen(\Acme\boletinesBundle\Entity\Examen $idExamen = null)
    {
        $this->idExamen = $idExamen;

        return $this;
    }

    /**
     * Get idExamen
     *
     * @return \Acme\boletinesBundle\Entity\Examen 
     */
    public function getIdExamen()
    {
        return $this->idExamen;
    }

    /**
     * Set idArchivo
     *
     * @param \Acme\boletinesBundle\Entity\Archivo $idArchivo
     * @return ExamenArchivo
     */
    public function setIdArchivo(\Acme\boletinesBundle\Entity\Archivo $idArchivo = null)
    {
        $this->idArchivo = $idArchivo;

        return $this;
    }

    /**
     * Get idArchivo
     *
     * @return \Acme\boletinesBundle\Entity\Archivo 
     */
    public function getIdArchivo()
    {
        return $this->idArchivo;
    }
}
