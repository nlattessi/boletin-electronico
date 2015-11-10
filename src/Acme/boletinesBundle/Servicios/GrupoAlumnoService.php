<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 02-Nov-15
 * Time: 04:13 PM
 */

namespace Acme\boletinesBundle\Servicios;
use Doctrine\ORM\EntityManager;

class GrupoAlumnoService {
    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function cantidadAlumnos($idGrupo){
        $qb =  $this->em->createQueryBuilder();
        $qb->select('count(grupo.id)');
        $qb->from('BoletinesBundle:AlumnoGrupoAlumno','grupo');
        $qb->where('grupo.grupoAlumno = ?1');
        $qb->setParameter(1, $idGrupo);

        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    public function listaAlumnos($idGrupo){
        $alumnos = array();

        $alumnosGrupoAlumnos = $this->em->getRepository('BoletinesBundle:AlumnoGrupoAlumno')->findBy(array('grupoAlumno' => $idGrupo));
        foreach($alumnosGrupoAlumnos as $alumnoGrupoAlumno){
            array_push($alumnos,$alumnoGrupoAlumno->getAlumno() );
        }
        return $alumnos;
    }

}