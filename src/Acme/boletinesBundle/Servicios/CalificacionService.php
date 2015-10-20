<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 22-Jul-15
 * Time: 05:33 PM
 */
namespace Acme\boletinesBundle\Servicios;
use Doctrine\ORM\EntityManager;

class CalificacionService {

    protected $em;
    const N_ULTIMA = 4;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    /**
     * @param $alumnoId
     * @return array
     * Devuelve lista de calificaciones
     */
    public function obtenerCalificaciones($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Calificacion')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            ->andWhere('c.validada = true')
            ->setParameter(1, $alumnoId)
            ->addOrderBy('c.fecha','DESC');

        $calificaciones = $queryBuilder->getQuery()->getResult();
        return $calificaciones;
    }
    public function obtenerUltimasCalificaciones($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Calificacion')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            ->andWhere('c.validada = true')
            ->setParameter(1, $alumnoId)
        ->setMaxResults(self::N_ULTIMA)
        ->addOrderBy('c.fecha','DESC');

        $calificaciones = $queryBuilder->getQuery()->getResult();
        return $calificaciones;
    }

}
