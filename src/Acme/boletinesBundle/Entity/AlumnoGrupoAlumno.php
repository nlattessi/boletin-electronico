<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlumnoGrupoAlumno
 *
 * @ORM\Table(name="alumno_grupo_alumno", indexes={@ORM\Index(name="alumno_fk_grupo_alumno_idx", columns={"id_alumno"}), @ORM\Index(name="grupo_alumno_fk_alumno_idx", columns={"id_grupo"})})
 * @ORM\Entity
 */
class AlumnoGrupoAlumno
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_alumno_grupo_alumno", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAlumnoGrupoAlumno;

    /**
     * @var \Acme\boletinesBundle\Entity\GrupoAlumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoAlumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo", referencedColumnName="id_grupo_alumno")
     * })
     */
    private $idGrupo;

    /**
     * @var \Acme\boletinesBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alumno", referencedColumnName="id_alumno")
     * })
     */
    private $idAlumno;

    /**
     * @return int
     */
    public function getIdAlumnoGrupoAlumno()
    {
        return $this->idAlumnoGrupoAlumno;
    }
    public function AlumnoGrupoAlumno($alumno, $grupoAlumno){
        $this->setAlumno($alumno);
        $this->setGrupoAlumno($grupoAlumno);
    }

    /**
     * @param int $idAlumnoGrupoAlumno
     */
    public function setIdAlumnoGrupoAlumno($idAlumnoGrupoAlumno)
    {
        $this->idAlumnoGrupoAlumno = $idAlumnoGrupoAlumno;
    }

    /**
     * @return GrupoAlumno
     */
    public function getGrupoAlumno()
    {
        return $this->idGrupo;
    }

    /**
     * @param GrupoAlumno $idGrupo
     */
    public function setGrupoAlumno($idGrupo)
    {
        $this->idGrupo = $idGrupo;
    }

    /**
     * @return Alumno
     */
    public function getAlumno()
    {
        return $this->idAlumno;
    }

    /**
     * @param Alumno $idAlumno
     */
    public function setAlumno($idAlumno)
    {
        $this->idAlumno = $idAlumno;
    }


}
