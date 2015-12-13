<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 12-Dec-15
 * Time: 05:04 PM
 */

namespace Acme\boletinesBundle\Servicios;


use Doctrine\ORM\EntityManager;

class PadreService {
    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function obtenerHijos($idPadre)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Alumno')->createQueryBuilder('a')
            ->where('a.padre1 = ?1')
            ->orWhere('a.padre2 = ?1')
            ->setParameter(1, $idPadre);
        $hijos = $queryBuilder->getQuery()->getResult();

        return $hijos;
    }

    public function cargarHijos($padre){

        $padre->setHijos($this->obtenerHijos($padre->getId()));

        return $padre;
    }
}