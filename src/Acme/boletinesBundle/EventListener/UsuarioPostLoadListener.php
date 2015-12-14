<?php

namespace Acme\boletinesBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Acme\boletinesBundle\Entity\Usuario;

class UsuarioPostLoadListener
{
    public function postLoad(LifecycleEventArgs $args)
    {
        $usuario = $args->getEntity();

        if (!$usuario instanceof Usuario) {
            return;
        }

        $em = $args->getEntityManager();

        switch($usuario->getRol()) {
            case 'ROLE_DOCENTE':
                $docente = $em->getRepository('BoletinesBundle:Docente')->find($usuario->getIdEntidadAsociada());
                $usuario->setEntidadAsociada($docente);
                break;

            case 'ROLE_ALUMNO':
                $alumno = $em->getRepository('BoletinesBundle:Alumno')->find($usuario->getIdEntidadAsociada());
                if ($alumno->getAvatar()) {
                    $alumno->getAvatar()->__load();
                }
                $usuario->setEntidadAsociada($alumno);
                break;

            case 'ROLE_PADRE':
                $padre = $em->getRepository('BoletinesBundle:Padre')->find($usuario->getIdEntidadAsociada());
                $usuario->setEntidadAsociada($padre);
                break;

            default:
                break;
        }
    }
}
