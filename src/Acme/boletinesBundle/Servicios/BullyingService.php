<?php

namespace Acme\boletinesBundle\Servicios;

use Doctrine\ORM\EntityManager;

use Acme\boletinesBundle\Entity\Bullying;


class BullyingService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create($user)
    {
        $bullying = new Bullying();
        $bullying->setAlumno($user->getEntidadAsociada());
        $bullying->setFechaCarga(new \Datetime('now'));

        $this->em->persist($bullying);
        $this->em->flush();

        return $bullying;
    }
}
