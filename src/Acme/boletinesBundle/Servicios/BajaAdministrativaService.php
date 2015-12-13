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

    public function darDeBajaPrestador($prestador)
    {
        $docentes = $this->em->getRepository('ChoferesBundle:Docente')->findBy(array('prestador' => $prestador));
        foreach ($docentes as $docente) {
            $this->darDeBaja($docente);
        }

        $sedes = $this->em->getRepository('ChoferesBundle:Sede')->findBy(array('prestador' => $prestador));
        foreach ($sedes as $sede) {
            $this->darDeBaja($sede);
        }

        $usuariosPrestador = $this->em->getRepository('ChoferesBundle:UsuarioPrestador')->findBy(array('prestador' => $prestador));
        foreach($usuariosPrestador as $usuarioPrestador) {
            $usuario = $usuarioPrestador->getUsuario();
            $this->darDeBaja($usuario);
        }

        $this->darDeBaja($prestador);
    }
}
