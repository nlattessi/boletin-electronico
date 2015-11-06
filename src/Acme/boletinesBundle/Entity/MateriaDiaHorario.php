<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MateriaDiaHorario
 *
 * @ORM\Table(name="materia_dia_horario", indexes={@ORM\Index(name="FK_BE9CEB52B36DFBF4", columns={"materia_id"})})
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
     * @ORM\Column(name="hora_inicio", type="integer", nullable=false)
     */
    private $horaInicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="hora_fin", type="integer", nullable=false)
     */
    private $horaFin;

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
     * @ORM\ManyToOne(targetEntity="Materia", inversedBy="horarios")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     */
    private $materia;



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
     * Set horaInicio
     *
     * @param integer $horaInicio
     * @return MateriaDiaHorario
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return integer 
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param integer $horaFin
     * @return MateriaDiaHorario
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return integer 
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return MateriaDiaHorario
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
     * @return MateriaDiaHorario
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
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return MateriaDiaHorario
     */
    public function setMateria(\Acme\boletinesBundle\Entity\Materia $materia = null)
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
    public function __toString(){
        return $this->getDia() . ' de ' . $this->getHoraInicio() . ' hasta ' . $this->getHoraFin();
    }

}
