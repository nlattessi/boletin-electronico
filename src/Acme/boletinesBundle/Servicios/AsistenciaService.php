<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 16-Oct-15
 * Time: 04:08 PM
 */

namespace Acme\boletinesBundle\Servicios;

use Doctrine\ORM\EntityManager;


class AsistenciaService {

    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    /**
     * @param $alumno
     * @return array
     * Devuelve una lista de AlumnoAsistencias
     */
    public function obtenerAsistenciaAlumno($alumno){

        $asistenciaes = array();
        $queryBuilder = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->createQueryBuilder('d')
            ->where('d.alumno = ?1')
            ->setParameter(1, $alumno);
        $asistenciasAlumno = $queryBuilder->getQuery()->getResult();
/*
        foreach($asistenciasAlumno as $asistenciaAlumno){
           array_push($asistenciaes,$asistenciaAlumno->getAsistencia() ) ;
        }*/
        return $asistenciasAlumno;
    }


    /**
     * @param $alumno
     * @return array
     * Devuelve una lista de AlumnoAsistencia
     */
    public function obtenerInasistenciasPorAlumno($alumno){

        $queryBuilder = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->createQueryBuilder('d')
            ->where('d.alumno = ?1')
            ->andWhere('d.valor = ?2')
            ->setParameter(1, $alumno)
            ->setParameter(2, self::VALOR_INASISTENCIA);

        $asistenciasAlumno = $queryBuilder->getQuery()->getResult();
        return $asistenciasAlumno;
    }

    /**
     * @param $alumno
     * @return array
     * Devuelve una lista de AlumnoAsistencia
     */
    public function obtenerTardesPorAlumno($alumno){

        $queryBuilder = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->createQueryBuilder('d')
            ->where('d.alumno = ?1')
            ->andWhere('d.valor = ?2')
            ->setParameter(1, $alumno)
            ->setParameter(2, self::VALOR_TARDE);

        $asistenciasAlumno = $queryBuilder->getQuery()->getResult();
        return $asistenciasAlumno;
    }
}