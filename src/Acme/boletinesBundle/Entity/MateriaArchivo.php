<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MateriaArchivo
 *
 * @ORM\Table(name="materia_archivo", indexes={@ORM\Index(name="materia_fk_archivo", columns={"id_materia"}), @ORM\Index(name="archivo_fk_materia", columns={"id_archivo"})})
 * @ORM\Entity
 */
class MateriaArchivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_materia_archivo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMateriaArchivo;

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
     * @var \Acme\boletinesBundle\Entity\Archivo
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_archivo", referencedColumnName="id_archivo")
     * })
     */
    private $idArchivo;

    public function MateriaArchivo($materia, $archivo){
        $this->setArchivo($archivo);
        $this->setMateria($materia);
    }

    /**
     * @return int
     */
    public function getIdMateriaArchivo()
    {
        return $this->idMateriaArchivo;
    }

    /**
     * @param int $idMateriaArchivo
     */
    public function setIdMateriaArchivo($idMateriaArchivo)
    {
        $this->idMateriaArchivo = $idMateriaArchivo;
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
     * @return Archivo
     */
    public function getArchivo()
    {
        return $this->idArchivo;
    }

    /**
     * @param Archivo $idArchivo
     */
    public function setArchivo($idArchivo)
    {
        $this->idArchivo = $idArchivo;
    }




    /**
     * Set idMateria
     *
     * @param \Acme\boletinesBundle\Entity\Materia $idMateria
     * @return MateriaArchivo
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
     * Set idArchivo
     *
     * @param \Acme\boletinesBundle\Entity\Archivo $idArchivo
     * @return MateriaArchivo
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
