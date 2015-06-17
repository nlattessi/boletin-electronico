<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="grupo_alumno")
 */
class GrupoAlumno
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $es_curso;

    public function __toString()
    {
        return $this->getNombre();
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
     * Set nombre
     *
     * @param string $nombre
     * @return GrupoAlumno
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
     * Set es_curso
     *
     * @param boolean $esCurso
     * @return GrupoAlumno
     */
    public function setEsCurso($esCurso)
    {
        $this->es_curso = $esCurso;

        return $this;
    }

    /**
     * Get es_curso
     *
     * @return boolean 
     */
    public function getEsCurso()
    {
        return $this->es_curso;
    }
}
