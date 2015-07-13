<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", indexes={@ORM\Index(name="padre2_fk_alumno", columns={"id_usuario_padre2"}), @ORM\Index(name="usuarior_fk_alumno", columns={"id_usuario_alumno"}), @ORM\Index(name="padre1_fk_alumno", columns={"id_usuario_padre1"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_alumno", type="string", length=45, nullable=false)
     */
    private $nombreAlumno;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_alumno", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAlumno;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_alumno", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioAlumno;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_padre1", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioPadre1;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_padre2", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioPadre2;

    /**
     * @return string
     */
    public function getNombreAlumno()
    {
        return $this->nombreAlumno;
    }

    /**
     * @param string $nombreAlumno
     */
    public function setNombreAlumno($nombreAlumno)
    {
        $this->nombreAlumno = $nombreAlumno;
    }

    /**
     * @return int
     */
    public function getIdAlumno()
    {
        return $this->idAlumno;
    }

    /**
     * @param int $idAlumno
     */
    public function setIdAlumno($idAlumno)
    {
        $this->idAlumno = $idAlumno;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioAlumno()
    {
        return $this->idUsuarioAlumno;
    }

    /**
     * @param Usuario $idUsuarioAlumno
     */
    public function setUsuarioAlumno($idUsuarioAlumno)
    {
        $this->idUsuarioAlumno = $idUsuarioAlumno;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioPadre1()
    {
        return $this->idUsuarioPadre1;
    }

    /**
     * @param Usuario $idUsuarioPadre1
     */
    public function setUsuarioPadre1($idUsuarioPadre1)
    {
        $this->idUsuarioPadre1 = $idUsuarioPadre1;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioPadre2()
    {
        return $this->idUsuarioPadre2;
    }

    /**
     * @param Usuario $idUsuarioPadre2
     */
    public function setUsuarioPadre2($idUsuarioPadre2)
    {
        $this->idUsuarioPadre2 = $idUsuarioPadre2;
    }

    public function __toString(){
        return $this->getNombreAlumno();
    }


    /**
     * Set idUsuarioAlumno
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioAlumno
     * @return Alumno
     */
    public function setIdUsuarioAlumno(\Acme\boletinesBundle\Entity\Usuario $idUsuarioAlumno = null)
    {
        $this->idUsuarioAlumno = $idUsuarioAlumno;

        return $this;
    }

    /**
     * Get idUsuarioAlumno
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getIdUsuarioAlumno()
    {
        return $this->idUsuarioAlumno;
    }

    /**
     * Set idUsuarioPadre1
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioPadre1
     * @return Alumno
     */
    public function setIdUsuarioPadre1(\Acme\boletinesBundle\Entity\Usuario $idUsuarioPadre1 = null)
    {
        $this->idUsuarioPadre1 = $idUsuarioPadre1;

        return $this;
    }

    /**
     * Get idUsuarioPadre1
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getIdUsuarioPadre1()
    {
        return $this->idUsuarioPadre1;
    }

    /**
     * Set idUsuarioPadre2
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $idUsuarioPadre2
     * @return Alumno
     */
    public function setIdUsuarioPadre2(\Acme\boletinesBundle\Entity\Usuario $idUsuarioPadre2 = null)
    {
        $this->idUsuarioPadre2 = $idUsuarioPadre2;

        return $this;
    }

    /**
     * Get idUsuarioPadre2
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getIdUsuarioPadre2()
    {
        return $this->idUsuarioPadre2;
    }
}
