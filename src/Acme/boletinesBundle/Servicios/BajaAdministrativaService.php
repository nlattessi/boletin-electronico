<?php

namespace Acme\boletinesBundle\Servicios;

use Doctrine\ORM\EntityManager;

class BajaAdministrativaService
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function darDeBaja($entity)
    {
        $entity->setActivo(false);
        $this->em->persist($entity);
        $this->em->flush();
    }

}
