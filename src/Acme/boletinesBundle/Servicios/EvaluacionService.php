<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 02-Nov-15
 * Time: 07:55 PM
 */

namespace Acme\boletinesBundle\Servicios;
use Doctrine\ORM\EntityManager;

class EvaluacionService {
    protected $em;
    const N_DEFAULT = 4;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function evaluacionesPorMateria($idMateria){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Evaluacion')->createQueryBuilder('e')
            ->where('e.materia = ?1')
            ->setParameter(1, $idMateria);

        $evaluaciones = $queryBuilder->getQuery()->getResult();
        return $evaluaciones;
    }

    public function evaluacionesPorDocente($idDocente){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Evaluacion')->createQueryBuilder('e')
            ->where('e.docente = ?1')
            ->setParameter(1, $idDocente);

        $evaluaciones = $queryBuilder->getQuery()->getResult();
        return $evaluaciones;
    }

    public function proximasNEvaluacionesPorDocente($idDocente, $n){
        $limite = self::N_DEFAULT;
        if($n){
            $limite = $n;
        }
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Evaluacion')->createQueryBuilder('e')
            ->where('e.docente = ?1')
            ->setParameter(1, $idDocente)
            ->orderBy('e.fecha','DESC')
        ->setMaxResults($limite);

        $evaluaciones = $queryBuilder->getQuery()->getResult();
        return $evaluaciones;
    }
}