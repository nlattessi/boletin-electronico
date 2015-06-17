<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="docente_materia")
 */
class DocenteMateria
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Docente")
     * @ORM\JoinColumn(name="docente_id", referencedColumnName="id", nullable=false)
     */
    protected $docente;

    /**
     * @ORM\ManyToOne(targetEntity="Materia")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id", nullable=false)
     */
    protected $materia;

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
     * Set docente
     *
     * @param \Acme\boletinesBundle\Entity\Docente $docente
     * @return DocenteMateria
     */
    public function setDocente(\Acme\boletinesBundle\Entity\Docente $docente)
    {
        $this->docente = $docente;

        return $this;
    }

    /**
     * Get docente
     *
     * @return \Acme\boletinesBundle\Entity\Docente 
     */
    public function getDocente()
    {
        return $this->docente;
    }

    /**
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return DocenteMateria
     */
    public function setMateria(\Acme\boletinesBundle\Entity\Materia $materia)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return \Acme\boletinesBundle\Entity\Materia 
     */
    public function getMateria()
    {
        return $this->materia;
    }
}
