<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materia
 *
 * @ORM\Table(name="materia", indexes={@ORM\Index(name="FK_6DF052845DC80656", columns={"tipo_materia_id"})})
 * @ORM\Entity
 */
class Materia
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

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
     * @var \Acme\boletinesBundle\Entity\TipoMateria
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\TipoMateria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_materia_id", referencedColumnName="id")
     * })
     */
    private $tipoMateria;

    /**
     * @var \Acme\boletinesBundle\Entity\Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id")
     * })
     */
    private $establecimiento;
    private $alumnos;
    private $gruposAlumnos;
    private $archivos;
    private $docentes;

    /**
     * @ORM\OneToMany(targetEntity="MateriaDiaHorario", mappedBy="materia", cascade={"remove"})
     */
    private $horarios;


    /**
     * @ORM\OneToMany(targetEntity="Evaluacion", mappedBy="materia", cascade={"remove"})
     */
    private $evaluaciones;


    public function __construct()
    {
        $this->creationTime = new \DateTime();
        $this->horarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Materia
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
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Materia
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
     * @return Materia
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
     * Set tipoMateria
     *
     * @param \Acme\boletinesBundle\Entity\TipoMateria $tipoMateria
     * @return Materia
     */
    public function setTipoMateria(\Acme\boletinesBundle\Entity\TipoMateria $tipoMateria = null)
    {
        $this->tipoMateria = $tipoMateria;

        return $this;
    }

    /**
     * Get tipoMateria
     *
     * @return \Acme\boletinesBundle\Entity\TipoMateria
     */
    public function getTipoMateria()
    {
        return $this->tipoMateria;
    }

    /**
     * @return array
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    /**
     * @param array $alumnos
     */
    public function setAlumnos($alumnos)
    {
        $this->alumnos = $alumnos;
    }

    public function getCantidadAlumnos(){
        return count($this->alumnos);
    }

    /**
     * @return array
     */
    public function getGruposAlumnos()
    {
        return $this->gruposAlumnos;
    }

    /**
     * @param array $gruposAlumnos
     */
    public function setGruposAlumnos($gruposAlumnos)
    {
        $this->gruposAlumnos = $gruposAlumnos;
    }




    /**
     * @return mixed
     */
    public function getHorarios()
    {
        return $this->horarios;
    }

    /**
     * @param mixed $horarios
     *
     *
     */
    public function addHorarios(MateriaDiaHorario $e)
    {
        $this->horarios[] = $e;
        $e->setMateria($this);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvaluaciones()
    {
        return $this->evaluaciones;
    }

    public function addEvaluaciones(Evaluacion $e)
    {
        $this->evaluaciones[] = $e;
        $e->setMateria($this);

        return $this;
    }
    /**
     * @param mixed $evaluaciones
     */
    public function setEvaluaciones($evaluaciones)
    {
        $this->evaluaciones = $evaluaciones;
    }




    /**
     * @return ArrayCollection
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * @param ArrayCollection $archivos
     */
    public function setArchivos($archivos)
    {
        $this->archivos = $archivos;
    }

    /**
     * @return mixed
     */
    public function getDocentes()
    {
        return $this->docentes;
    }

    /**
     * @param mixed $docentes
     */
    public function setDocentes($docentes)
    {
        $this->docentes = $docentes;
    }

    public function __toString(){
        return $this->getNombre();
    }

    /**
     * Set establecimiento
     *
     * @param \Acme\boletinesBundle\Entity\Establecimiento $establecimiento
     * @return Materia
     */
    public function setEstablecimiento(\Acme\boletinesBundle\Entity\Establecimiento $establecimiento = null)
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return \Acme\boletinesBundle\Entity\Establecimiento
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }
}
