<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="materia_dia_horario")
 */
class MateriaDiaHorario
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Materia")
     * @ORM\JoinColumn(name="materia_id", referencedColumnName="id", nullable=false)
     */
    protected $materia;

    /**
     * @ORM\Column(type="string")
     */
    protected $dia;

    /**
     * @ORM\Column(type="time")
     */
    protected $hora_catedra_inico;

    /**
     * @ORM\Column(type="time")
     */
    protected $hora_catedra_fin;

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
     * Set hora_catedra_inico
     *
     * @param \DateTime $horaCatedraInico
     * @return MateriaDiaHorario
     */
    public function setHoraCatedraInico($horaCatedraInico)
    {
        $this->hora_catedra_inico = $horaCatedraInico;

        return $this;
    }

    /**
     * Get hora_catedra_inico
     *
     * @return \DateTime 
     */
    public function getHoraCatedraInico()
    {
        return $this->hora_catedra_inico;
    }

    /**
     * Set hora_catedra_fin
     *
     * @param \DateTime $horaCatedraFin
     * @return MateriaDiaHorario
     */
    public function setHoraCatedraFin($horaCatedraFin)
    {
        $this->hora_catedra_fin = $horaCatedraFin;

        return $this;
    }

    /**
     * Get hora_catedra_fin
     *
     * @return \DateTime 
     */
    public function getHoraCatedraFin()
    {
        return $this->hora_catedra_fin;
    }

    /**
     * Set materia
     *
     * @param \Acme\boletinesBundle\Entity\Materia $materia
     * @return MateriaDiaHorario
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
