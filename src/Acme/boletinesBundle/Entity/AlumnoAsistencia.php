<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlumnoAsistencia
 *
 * @ORM\Table(name="alumno_asistencia", indexes={@ORM\Index(name="FK_D30A8664320260C0", columns={"alumno_id"}), @ORM\Index(name="FK_D30A866455D9EBE2", columns={"justificacion_id"}), @ORM\Index(name="FK_D30A86647DACCA5A", columns={"asistencia_id"})})
 * @ORM\Entity
 */
class AlumnoAsistencia
{
    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=1, nullable=false)
     */
    private $valor;

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
     * @var \Acme\boletinesBundle\Entity\Asistencia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Asistencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asistencia_id", referencedColumnName="id")
     * })
     */
    private $asistencia;

    /**
     * @var \Acme\boletinesBundle\Entity\Justificacion
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Justificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="justificacion_id", referencedColumnName="id")
     * })
     */
    private $justificacion;

    /**
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */
    private $alumno;



    /**
     * Set valor
     *
     * @param string $valor
     * @return AlumnoAsistencia
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return AlumnoAsistencia
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
     * @return AlumnoAsistencia
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
     * Set asistencia
     *
     * @param \Acme\boletinesBundle\Entity\Asistencia $asistencia
     * @return AlumnoAsistencia
     */
    public function setAsistencia(\Acme\boletinesBundle\Entity\Asistencia $asistencia = null)
    {
        $this->asistencia = $asistencia;

        return $this;
    }

    /**
     * Get asistencia
     *
     * @return \Acme\boletinesBundle\Entity\Asistencia 
     */
    public function getAsistencia()
    {
        return $this->asistencia;
    }

    /**
     * Set justificacion
     *
     * @param \Acme\boletinesBundle\Entity\Justificacion $justificacion
     * @return AlumnoAsistencia
     */
    public function setJustificacion(\Acme\boletinesBundle\Entity\Justificacion $justificacion = null)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return \Acme\boletinesBundle\Entity\Justificacion 
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set alumno
     *
     * @param \Acme\boletinesBundle\Entity\Alumno $alumno
     * @return AlumnoAsistencia
     */
    public function setAlumno(\Acme\boletinesBundle\Entity\Alumno $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return \Acme\boletinesBundle\Entity\Alumno 
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    public function __toString(){
        return $this->getId();
    }
}
