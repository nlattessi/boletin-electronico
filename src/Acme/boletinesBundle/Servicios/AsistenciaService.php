<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 16-Oct-15
 * Time: 04:08 PM
 */

namespace Acme\boletinesBundle\Servicios;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class AsistenciaService {

    protected $em;
    const VALOR_INASISTENCIA = 'A';
    const VALOR_TARDE = 'T';
    private $endYear;
    private $startYear;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
        $this->session = new Session();
        $this->endYear = $this->session->get('endYear');
        $this->startYear = $this->session->get('startYear');
    }

    /**
     * @param $alumno
     * @return array
     * Devuelve una lista de AlumnoAsistencias
     */
    public function obtenerAsistenciaAlumno($alumno){
        return $this->obtenerAsistenciaAlumnoLimite($alumno, null);
    }

    public function obtenerAsistenciaAlumnoLimite($alumno, $limite){

        $queryBuilder = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->createQueryBuilder('d')
            ->where('d.alumno = ?1')
            ->andWhere('d.creationTime > :startYear')
            ->andWhere('d.creationTime < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->setParameter(1, $alumno);
        if($limite){
            $queryBuilder->setMaxResults($limite);
        }
        $asistenciasAlumno = $queryBuilder->getQuery()->getResult();
        /*
                foreach($asistenciasAlumno as $asistenciaAlumno){
                   array_push($asistenciaes,$asistenciaAlumno->getAsistencia() ) ;
                }*/
        return $asistenciasAlumno;
    }

    public function obtenerAsistenciaAlumnoFiltrada($alumno,$fechaDesde, $fechaHasta, $asistencia){

        $queryBuilder = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->createQueryBuilder('d')
            ->where('d.alumno = ?1')
            ->join('BoletinesBundle:Asistencia'  , 'c', 'WITH','c.id = d.asistencia  '  )
            ->andWhere('d.creationTime > :startYear')
            ->andWhere('d.creationTime < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->setParameter(1, $alumno);
        if($fechaDesde){
            $queryBuilder->andWhere('c.fecha > :fd')
                ->setParameter('fd',$fechaDesde);
        }
        if($fechaHasta){
            $queryBuilder->andWhere('c.fecha < :fh')
                ->setParameter('fh',$fechaHasta);
        }
        if($asistencia != ""){
           $queryBuilder->andWhere('d.valor = :val')
               ->setParameter('val',$asistencia);
        }
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
            ->andWhere('d.creationTime > :startYear')
            ->andWhere('d.creationTime < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
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
            ->andWhere('d.creationTime > :startYear')
            ->andWhere('d.creationTime < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->setParameter(1, $alumno)
            ->setParameter(2, self::VALOR_TARDE);

        $asistenciasAlumno = $queryBuilder->getQuery()->getResult();
        return $asistenciasAlumno;
    }

    public function obtenerFaltasTotales($alumno, $tardesFaltas){
        $ausentes = $this->obtenerInasistenciasPorAlumno($alumno);
        $tardes = $this->obtenerTardesPorAlumno($alumno);
        $faltas = count($ausentes) + count($tardes) / $tardesFaltas;
        return $faltas;

    }

    /**
     * @param $alumno
     * @return array
     * Devuelve una lista de AlumnoAsistencias
     */
    public function obtenerUltimasMateria($materiaId){

        $asistenciaes = array();
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Asistencia')->createQueryBuilder('d')
            ->where('d.materia = ?1')
            ->setParameter(1, $materiaId)
        ->orderBy('d.fecha','DESC')
        ->setMaxResults(7);
        $asistenciasMateria = $queryBuilder->getQuery()->getResult();
        /*
                foreach($asistenciasAlumno as $asistenciaAlumno){
                   array_push($asistenciaes,$asistenciaAlumno->getAsistencia() ) ;
                }*/
        return $asistenciasMateria;
    }

    public function obtenerAlumnoAsistenciaDelDia($fecha, $idMateria){

        $queryBuilder = $this->em->getRepository('BoletinesBundle:Asistencia')->createQueryBuilder('d')
            ->where('d.fecha = ?1')
            ->andWhere('d.materia = ?2')
            ->setParameter(1, $fecha)
            ->setParameter(2, $idMateria)
            ->setMaxResults(1);
        $asistencia = $queryBuilder->getQuery()->getOneOrNullResult();
        $asistenciasAlumno = array();
        if($asistencia){
            $queryBuilder = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->createQueryBuilder('d')
                ->where('d.asistencia = ?1')
                ->setParameter(1, $asistencia->getId());
            $asistenciasAlumno = $queryBuilder->getQuery()->getResult();
        }


        return $asistenciasAlumno;
    }

}
