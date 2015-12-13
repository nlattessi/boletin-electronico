<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 20-Oct-15
 * Time: 06:10 PM
 */

namespace Acme\boletinesBundle\Servicios;


use Doctrine\ORM\EntityManager;

class ConvivenciaService {
    protected $em;
    const VALOR_POSITIVO = 1;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function obtenerConvivenciaAlumno($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            ->andWhere('c.validado = true')
            ->setParameter(1, $alumnoId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }

    public function obtenerConvivenciaPositivaAlumno($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            ->andWhere('c.validado = true')
            ->andWhere('c.valor = true')
            ->setParameter(1, $alumnoId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }

    public function obtenerConvivenciaNegativaAlumno($alumnoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.alumno = ?1')
            ->andWhere('c.validado = true')
            ->andWhere('c.valor = false')
            ->setParameter(1, $alumnoId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }

    public function obtenerConvivenciaPorUsuario($usuarioId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Convivencia')->createQueryBuilder('c')
            ->where('c.usuarioCarga = ?1')
            ->setParameter(1, $usuarioId)
            ->addOrderBy('c.fechaSuceso','DESC');

        $convivencia = $queryBuilder->getQuery()->getResult();
        return $convivencia;
    }
}