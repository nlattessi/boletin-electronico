<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 22-Jul-15
 * Time: 05:33 PM
 */
namespace Acme\boletinesBundle\Servicios;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class CalificacionService {

    protected $em;
    const N_ULTIMA = 4;
    const ESQUEMA_GENERAL_ID = 1;
    private $endYear;
    private $startYear;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
        $this->session = new Session();
        $this->endYear = $this->session->get('endYear');
        $this->startYear = $this->session->get('startYear');
    }

    /**
     * @param $alumnoId
     * @return array
     * Devuelve lista de calificaciones
     */
    public function obtenerCalificaciones($alumnoId){
    $queryBuilder = $this->em->getRepository('BoletinesBundle:Calificacion')->createQueryBuilder('c')
        ->where('c.alumno = ?1')
        ->andWhere('c.fechaCreacion > :startYear')
        ->andWhere('c.fechaCreacion < :endYear')
        ->setParameter('startYear', $this->startYear)
        ->setParameter('endYear', $this->endYear)
        ->setParameter(1, $alumnoId)
        ->addOrderBy('c.fecha','DESC');

    $calificaciones = $queryBuilder->getQuery()->getResult();
    return $calificaciones;
}

    public function obtenerCalificacionesPorEvaluacion($evaluacionId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Calificacion')->createQueryBuilder('c')
            ->where('c.evaluacion = ?1')
            ->setParameter(1, $evaluacionId)
            ->addOrderBy('c.fecha','DESC');

        $calificaciones = $queryBuilder->getQuery()->getResult();
        return $calificaciones;
    }
    public function obtenerUltimasCalificaciones($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Calificacion')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            ->andWhere('c.fechaCreacion > :startYear')
            ->andWhere('c.fechaCreacion < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->setParameter(1, $alumnoId)
        ->setMaxResults(self::N_ULTIMA)
        ->addOrderBy('c.fecha','DESC');

        $calificaciones = $queryBuilder->getQuery()->getResult();
        return $calificaciones;
    }

    public function valoresAceptados($establecimiento){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:ValorCalificacion')->createQueryBuilder('c')
            ->where('c.esquemaCalificacion = ?1')
            ->orWhere('c.esquemaCalificacion = ?2')
            ->setParameter(1, $establecimiento->getEsquemaCalificacion()->getId())
            ->setParameter(2, self::ESQUEMA_GENERAL_ID);

        $valores = $queryBuilder->getQuery()->getResult();
        return $valores;
    }

    public function valoresAceptadosReporte($establecimiento){
         $queryBuilder = $this->em->getRepository('BoletinesBundle:ValorCalificacion')->createQueryBuilder('c')
             ->select('c.id, c.nombre')
             ->where('c.esquemaCalificacion = ?1')
             ->orWhere('c.esquemaCalificacion = ?2')
             ->setParameter(1, $establecimiento->getEsquemaCalificacion()->getId())
             ->setParameter(2, self::ESQUEMA_GENERAL_ID);

         $valores = $queryBuilder->getQuery()->getResult();
         return $valores;
     }

}
