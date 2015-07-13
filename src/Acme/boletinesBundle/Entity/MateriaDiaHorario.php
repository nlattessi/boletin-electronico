<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MateriaDiaHorario
 *
 * @ORM\Table(name="materia_dia_horario", indexes={@ORM\Index(name="materia_fk_dia_hora", columns={"id_materia"})})
 * @ORM\Entity
 */
class MateriaDiaHorario
{
    /**
     * @var string
     *
     * @ORM\Column(name="dia", type="string", length=10, nullable=false)
     */
    private $dia;

    /**
     * @var integer
     *
     * @ORM\Column(name="hora_catedra_inicio", type="integer", nullable=false)
     */
    private $horaCatedraInicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="hora_catedra_fin", type="integer", nullable=false)
     */
    private $horaCatedraFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_materia_dia_horario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMateriaDiaHorario;

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
     * Set dia
     *
     * @param string $dia
     * @return MateriaDiaHorario
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return string 
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set horaCatedraInicio
     *
     * @param integer $horaCatedraInicio
     * @return MateriaDiaHorario
     */
    public function setHoraCatedraInicio($horaCatedraInicio)
    {
        $this->horaCatedraInicio = $horaCatedraInicio;

        return $this;
    }

    /**
     * Get horaCatedraInicio
     *
     * @return integer 
     */
    public function getHoraCatedraInicio()
    {
        return $this->horaCatedraInicio;
    }

    /**
     * Set horaCatedraFin
     *
     * @param integer $horaCatedraFin
     * @return MateriaDiaHorario
     */
    public function setHoraCatedraFin($horaCatedraFin)
    {
        $this->horaCatedraFin = $horaCatedraFin;

        return $this;
    }

    /**
     * Get horaCatedraFin
     *
     * @return integer 
     */
    public function getHoraCatedraFin()
    {
        return $this->horaCatedraFin;
    }

    /**
     * Get idMateriaDiaHorario
     *
     * @return integer 
     */
    public function getIdMateriaDiaHorario()
    {
        return $this->idMateriaDiaHorario;
    }

    /**
     * Set idMateria
     *
     * @param \Acme\boletinesBundle\Entity\Materia $idMateria
     * @return MateriaDiaHorario
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
}
