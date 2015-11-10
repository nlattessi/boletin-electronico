<?php

namespace Acme\boletinesBundle\Servicios;

use Acme\boletinesBundle\Entity\Mensaje;
use Acme\boletinesBundle\Entity\MensajeUsuario;
use Doctrine\ORM\EntityManager;

class MensajeService
{

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getMensajes($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy(
            array('usuario' => $user, 'borrado' => false),
            array('creationTime' => 'DESC')
        );

        return $mensajes;
    }

    public function getMensajesNotLeidos($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy(array(
            'usuario' => $user, 'borrado' => false, 'leido' => false),
            array('creationTime' => 'DESC')
        );

        return $mensajes;
    }

    public function getMensajesEnviados($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:Mensaje')->findBy(
            array('usuario' => $user),
            array('fechaEnvio' => 'DESC')
        );

        return $mensajes;
    }

    public function getMensajesBorrados($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy(
            array('usuario' => $user, 'borrado' => true),
            array('creationTime' => 'DESC')
        );

        return $mensajes;
    }

    public function newMensaje($user, $titulo, $texto)
    {
        $mensaje = new Mensaje();
        $mensaje->setUsuario($user);
        $mensaje->setTitulo($titulo);
        $mensaje->setTexto($texto);
        $mensaje->setFechaEnvio(new \DateTime('now'));

        $this->em->persist($mensaje);
        $this->em->flush();

        return $mensaje;
    }

    public function newMensajeUsuario($user, $mensaje)
    {
        $mensajeUsuario = new MensajeUsuario();
        $mensajeUsuario->setUsuario($user);
        $mensajeUsuario->setBorrado(false);
        $mensajeUsuario->setLeido(false);
        $mensajeUsuario->setMensaje($mensaje);
        $mensajeUsuario->setCreationTime(new \DateTime('now'));
        $mensajeUsuario->setUpdateTime(new \DateTime('now'));

        $this->em->persist($mensajeUsuario);
        $this->em->flush();

        return $mensajeUsuario;
    }

    public function deleteMensaje($user, $id)
    {
        $mensaje = $this->getMensajeById($id);

        $mensajeUsuario = $this->getMensajeUsuarioByUsuarioAndMensaje($user, $mensaje);

        return $this->mensajeUsuarioSetBorrado($mensajeUsuario);
    }

    public function deleteMensajeUsuarioById($id)
    {
        $mensajeUsuario = $this->getMensajeUsuarioById($id);

        return $this->mensajeUsuarioSetBorrado($mensajeUsuario);
    }

    public function deleteMensajesUsuario($ids)
    {
        foreach ($ids as $id) {
            $this->deleteMensajeUsuarioById($id);
        }
    }

    public function readMensaje($user, $id)
    {
        $mensaje = $this->getMensajeById($id);

        $mensajeUsuario = $this->getMensajeUsuarioByUsuarioAndMensaje($user, $mensaje);

        $this->mensajeUsuarioSetLeido($mensajeUsuario);

        // if ($this->mensajeUsuarioSetLeido($mensajeUsuario)) {
        //   return $mensaje;
        // }

        return $mensaje;
    }

    private function getMensajeById($id)
    {
        $mensaje = $this->em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('id' => $id));

        return $mensaje;
    }

    private function getMensajeUsuarioById($id)
    {
        $mensajeUsuario = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->find($id);

        return $mensajeUsuario;
    }

    private function getMensajeUsuarioByUsuarioAndMensaje($user, $mensaje)
    {
        $mensajeUsuario = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findOneBy(['usuario' => $user, 'mensaje' => $mensaje]);

        return $mensajeUsuario;
    }

    private function mensajeUsuarioSetLeido($mensajeUsuario)
    {
        if ($mensajeUsuario instanceof MensajeUsuario) {
            $mensajeUsuario->setLeido(true);
            $mensajeUsuario->setUpdateTime(new \DateTime('now'));
            $this->em->persist($mensajeUsuario);
            $this->em->flush();

            return true;
        }

        return false;
    }

    private function mensajeUsuarioSetBorrado($mensajeUsuario)
    {
        if ($mensajeUsuario instanceof MensajeUsuario) {
            $mensajeUsuario->setBorrado(true);
            $mensajeUsuario->setUpdateTime(new \DateTime('now'));
            $this->em->persist($mensajeUsuario);
            $this->em->flush();

            return true;
        }

        return false;
    }
}
