<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 20-Oct-15
 * Time: 06:10 PM
 */

namespace Acme\boletinesBundle\Servicios;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class ConvivenciaService {
    protected $em;
    const VALOR_POSITIVO = 1;
    private $endYear;
    private $startYear;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
        $this->session = new Session();
        $this->endYear = $this->session->get('endYear');
        $this->startYear = $this->session->get('startYear');
    }

    public function obtenerConvivenciaAlumno($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            //->andWhere('c.validado = true')
            ->andWhere('c.activo = true')
            ->setParameter(1, $alumnoId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }

    public function obtenerConvivenciaPositivaAlumno($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            //->andWhere('c.validado = true')
            ->andWhere('c.valor = true')
            ->andWhere('c.activo = true')
            ->andWhere('c.creationTime > :startYear')
            ->andWhere('c.creationTime < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->setParameter(1, $alumnoId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }

    public function obtenerConvivenciaNegativaAlumno($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            //->andWhere('c.validado = true')
            ->andWhere('c.valor = false')
            ->andWhere('c.activo = true')
            ->andWhere('c.creationTime > :startYear')
            ->andWhere('c.creationTime < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->setParameter(1, $alumnoId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }

    public function obtenerConvivenciaPorUsuario($usuarioId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.usuarioCarga = ?1')
            ->andWhere('c.activo = true')
            ->andWhere('c.creationTime > :startYear')
            ->andWhere('c.creationTime < :endYear')
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->setParameter(1, $usuarioId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }
}
