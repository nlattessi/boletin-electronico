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

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    /**
     * @param $alumnoId
     * @return array
     * Devuelve lista de calificaciones
     */
    public function obtenerCalificaciones($alumnoId){
        $queryBuilder = $this->$em->getRepository('BoletinesBundle:Calificacion')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            ->setParameter(1, $alumnoId)
            ->setParameter(2, self::VALOR_INASISTENCIA);

        $calificaciones = $queryBuilder->getQuery()->getResult();
        return $calificaciones;
    }

}
