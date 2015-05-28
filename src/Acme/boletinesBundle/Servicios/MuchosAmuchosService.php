<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 28-May-15
 * Time: 11:22 AM
 */
namespace Acme\boletinesBundle\Servicios;
use Acme\boletinesBundle\Entity\Actividad;
use Acme\boletinesBundle\Entity\AlumnoMateria;
use Acme\boletinesBundle\Entity\CalendarioActividad;
use Acme\boletinesBundle\Entity\GrupoAlumnoMateria;
use Doctrine\ORM\EntityManager;

class MuchosAmuchosService {

    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function asociarAlumnoMateria($alumno, $materia){
        $alumnoMateria = new AlumnoMateria($alumno, $materia);
        $this->em->persist($alumnoMateria);
        $this->em->flush();

        return $alumnoMateria;
    }

    public function asociarGrupoAlumnoMateria($grupoAlumno, $materia){
        $grupoAlumnoMateria = new GrupoAlumnoMateria($grupoAlumno, $materia);
        $this->em->persist($grupoAlumnoMateria);
        $this->em->flush();

        return $grupoAlumnoMateria;
    }

    public function asociarCalendarioActividad($calendario, $actividad){
        $calendarioActividad = new CalendarioActividad($calendario, $actividad);
        $calendarioActividad->setCalendario($calendario);
        $calendarioActividad->setActividad($actividad);
        $this->em->persist($calendarioActividad);
        $this->em->flush();

        return $calendarioActividad;
    }


}