<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocenteMateria
 *
 * @ORM\Table(name="docente_materia", indexes={@ORM\Index(name="docente_fk_materia_idx", columns={"id_docente"}), @ORM\Index(name="materia_fk_docente_idx", columns={"id_materia"})})
 * @ORM\Entity
 */
class DocenteMateria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_docente_materia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDocenteMateria;

    /**
     * @var \Acme\boletinesBundle\Entity\Materia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Materia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_materia", referencedColumnName="id_materia")
     * })
     */
    private $idMateria;

    /**
     * @var \Acme\boletinesBundle\Entity\Docente
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Docente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_docente", referencedColumnName="id_docente")
     * })
     */
    private $idDocente;

    public function DocenteMateria($docente, $materia){
        $this->setDocente($docente);
        $this->setMateria($materia);
    }

    /**
     * @return int
     */
    public function getIdDocenteMateria()
    {
        return $this->idDocenteMateria;
    }

    /**
     * @param int $idDocenteMateria
     */
    public function setIdDocenteMateria($idDocenteMateria)
    {
        $this->idDocenteMateria = $idDocenteMateria;
    }

    /**
     * @return Materia
     */
    public function getMateria()
    {
        return $this->idMateria;
    }

    /**
     * @param Materia $idMateria
     */
    public function setMateria($idMateria)
    {
        $this->idMateria = $idMateria;
    }

    /**
     * @return Docente
     */
    public function getDocente()
    {
        return $this->idDocente;
    }

    /**
     * @param Docente $idDocente
     */
    public function setDocente($idDocente)
    {
        $this->idDocente = $idDocente;
    }



    /**
     * Set idMateria
     *
     * @param \Acme\boletinesBundle\Entity\Materia $idMateria
     * @return DocenteMateria
     */
    public function setIdMateria(\Acme\boletinesBundle\Entity\Materia $idMateria = null)
    {
        $this->idMateria = $idMateria;

        return $this;
    }

    /**
     * Get idMateria
     *
     * @return \Acme\boletinesBundle\Entity\Materia 
     */
    public function getIdMateria()
    {
        return $this->idMateria;
    }

    /**
     * Set idDocente
     *
     * @param \Acme\boletinesBundle\Entity\Docente $idDocente
     * @return DocenteMateria
     */
    public function setIdDocente(\Acme\boletinesBundle\Entity\Docente $idDocente = null)
    {
        $this->idDocente = $idDocente;

        return $this;
    }

    /**
     * Get idDocente
     *
     * @return \Acme\boletinesBundle\Entity\Docente 
     */
    public function getIdDocente()
    {
        return $this->idDocente;
    }
}
