<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="examen_archivo")
 */
class ExamenArchivo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Examen")
     * @ORM\JoinColumn(name="examen_id", referencedColumnName="id", nullable=false)
     */
    protected $examen;

    /**
     * @ORM\ManyToOne(targetEntity="Archivo")
     * @ORM\JoinColumn(name="archivo_id", referencedColumnName="id", nullable=false)
     */
    protected $archivo;

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
     * Set examen
     *
     * @param \Acme\boletinesBundle\Entity\Examen $examen
     * @return ExamenArchivo
     */
    public function setExamen(\Acme\boletinesBundle\Entity\Examen $examen)
    {
        $this->examen = $examen;

        return $this;
    }

    /**
     * Get examen
     *
     * @return \Acme\boletinesBundle\Entity\Examen 
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * Set archivo
     *
     * @param \Acme\boletinesBundle\Entity\Archivo $archivo
     * @return ExamenArchivo
     */
    public function setArchivo(\Acme\boletinesBundle\Entity\Archivo $archivo)
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
}
