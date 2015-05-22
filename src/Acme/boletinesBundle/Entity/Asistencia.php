<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia", indexes={@ORM\Index(name="materia_fk_asistencia", columns={"id_materia"}), @ORM\Index(name="usuario_fk_asistencia", columns={"id_usuario_cargador"})})
 * @ORM\Entity
 */
class Asistencia
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asistencia", type="datetime", nullable=false)
     */
    private $fechaAsistencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carga", type="datetime", nullable=false)
     */
    private $fechaCarga;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_asistencia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAsistencia;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_cargador", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioCargador;

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
     * @return \DateTime
     */
    public function getFechaAsistencia()
    {
        return $this->fechaAsistencia;
    }

    /**
     * @param \DateTime $fechaAsistencia
     */
    public function setFechaAsistencia($fechaAsistencia)
    {
        $this->fechaAsistencia = $fechaAsistencia;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }

    /**
     * @param \DateTime $fechaCarga
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;
    }

    /**
     * @return int
     */
    public function getIdAsistencia()
    {
        return $this->idAsistencia;
    }

    /**
     * @param int $idAsistencia
     */
    public function setIdAsistencia($idAsistencia)
    {
        $this->idAsistencia = $idAsistencia;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioCargador()
    {
        return $this->idUsuarioCargador;
    }

    /**
     * @param Usuario $idUsuarioCargador
     */
    public function setUsuarioCargador($idUsuarioCargador)
    {
        $this->idUsuarioCargador = $idUsuarioCargador;
    }

    /**
     * @return Materia
     */
    public function getIdMateria()
    {
        return $this->idMateria;
    }

    /**
     * @param Materia $idMateria
     */
    public function setIdMateria($idMateria)
    {
        $this->idMateria = $idMateria;
    }

    public function __toString(){
        return 'Asistencia del dia' . $this->getFechaAsistencia();
    }

}
