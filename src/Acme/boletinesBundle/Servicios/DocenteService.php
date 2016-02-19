<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 07-Feb-16
 * Time: 07:04 PM
 */

namespace Acme\boletinesBundle\Servicios;


use Doctrine\ORM\EntityManager;

class DocenteService {
    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function docentesPorEstablecimientoReporte($establecimientoId){
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Docente')->createQueryBuilder('d')
            ->select('d.id, d.nombre, d.apellido')
            ->where('d.establecimiento = ?1')
            ->setParameter(1, $establecimientoId);

        $docentes = $queryBuilder->getQuery()->getResult();
        return $docentes;
    }
}