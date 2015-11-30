<?php

namespace Acme\boletinesBundle\Servicios;

use Acme\boletinesBundle\Entity\Mensaje;
use Acme\boletinesBundle\Entity\MensajeUsuario;
use Doctrine\ORM\EntityManager;
use Acme\boletinesBundle\Entity\Usuario;

class MensajeService
{
    const RECIBIDO = 'recibido';
    const ENVIADO = 'enviado';
    const BORRADO = 'borrado';
    const ANTERIOR = 'ant';
    const SIGUIENTE = 'sig';

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getMensajesUsuario($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy(
            array('usuario' => $user, 'borrado' => false, 'borrador' => false),
            array('creationTime' => 'DESC')
        );

        return $mensajes;
    }

    public function getMensajesUsuarioNotLeidos($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy(array(
            'usuario' => $user, 'borrado' => false, 'leido' => false, 'borrador' => false),
            array('creationTime' => 'DESC')
        );

        return $mensajes;
    }

    public function getMensajesUsuarioBorrados($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy(
            array('usuario' => $user, 'borrado' => true, 'borrador' => false),
            array('creationTime' => 'DESC')
        );

        return $mensajes;
    }

    public function getMensajesEnviados($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:Mensaje')->findBy(
            array('usuario' => $user, 'borrador' => false),
            array('fechaEnvio' => 'DESC')
        );

        return $mensajes;
    }

    public function getMensajesBorradores($user)
    {
        $mensajes = $this->em->getRepository('BoletinesBundle:Mensaje')->findBy(
            array('usuario' => $user, 'borrador' => true),
            array('fechaEnvio' => 'DESC')
        );

        return $mensajes;
    }

    public function newMensaje($user, $titulo = "", $texto = "", $borrador = false)
    {
        $mensaje = new Mensaje();
        $mensaje->setUsuario($user);
        $mensaje->setTitulo($titulo);
        $mensaje->setTexto($texto);
        $mensaje->setBorrador($borrador);
        $mensaje->setFechaEnvio(new \DateTime('now'));

        $this->em->persist($mensaje);
        $this->em->flush();

        return $mensaje;
    }

    public function newMensajeUsuario($user, $mensaje, $borrador = false)
    {
        $mensajeUsuario = new MensajeUsuario();
        $mensajeUsuario->setUsuario($user);
        $mensajeUsuario->setBorrado(false);
        $mensajeUsuario->setLeido(false);
        $mensajeUsuario->setBorrador($borrador);
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

        return $mensaje;
    }

    private function getAnterior($mensaje, $mensajes)
    {
        $result = array_search($mensaje, $mensajes);

        $result = ($result > 0) ? ($result - 1) : $result;

        return $mensajes[$result];
    }

    private function getSiguiente($mensaje, $mensajes)
    {
        $result = array_search($mensaje, $mensajes);

        $result = ($result < count($mensajes) - 1) ? ($result + 1) : $result;

        return $mensajes[$result];
    }

    public function getAnteriorOSiguienteMensaje($user, $mensaje, $type = self::RECIBIDO, $direccion = self::ANTERIOR)
    {
        switch ($type) {
            case self::RECIBIDO:
                $mensajes = $this->getMensajesUsuario($user);
                break;

            case self::ENVIADO:
                $mensajes = $this->getMensajesEnviados($user);
                break;

            case self::BORRADO:
                $mensajes = $this->getMensajesUsuarioBorrados($user);

            default:
              break;
        }

        $mensaje = ($type == self::ENVIADO) ? $mensaje : $this->getMensajeUsuarioByUsuarioAndMensaje($user, $mensaje);

        return ($direccion == self::ANTERIOR) ? $this->getAnterior($mensaje, $mensajes) : $this->getSiguiente($mensaje, $mensajes);
    }

    public function getMensajeById($id)
    {
        $mensaje = $this->em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('id' => $id));

        return $mensaje;
    }

    public function saveBorrador($user, $titulo, $texto, $usersIds)
    {
        $mensaje = $this->newMensaje($user, $titulo, $texto, true);

        if (isset($usersIds)) {
            foreach ($usersIds as $userId) {
                $userRecibe = $this->em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
                if($userRecibe instanceof Usuario){
                    $this->newMensajeUsuario($userRecibe, $mensaje, true);
                }
            }
        }
    }

    public function updateBorrador($user, $titulo, $texto, $usersIds, $id)
    {
        $mensaje = $this->getMensajeById($id);

        $mensaje->setTitulo($titulo);
        $mensaje->setTexto($texto);
        $this->em->persist($mensaje);

        $mensajesUsuarios = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy([
            'mensaje' => $mensaje
        ]);
        foreach ($mensajesUsuarios as $mensajeUsuario) {
            $this->em->remove($mensajeUsuario);
        }

        $this->em->flush();

        if (isset($usersIds)) {
            foreach ($usersIds as $userId) {
                $userRecibe = $this->em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
                if($userRecibe instanceof Usuario){
                    $this->newMensajeUsuario($userRecibe, $mensaje, true);
                }
            }
        }
    }

    public function getMensajeBorradorParaEnviar($user, $titulo, $texto, $id)
    {
        $mensaje = $this->getMensajeById($id);

        $mensaje->setTitulo($titulo);
        $mensaje->setTexto($texto);
        $mensaje->setBorrador(false);
        $this->em->persist($mensaje);

        $mensajesUsuarios = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy([
            'mensaje' => $mensaje
        ]);
        foreach ($mensajesUsuarios as $mensajeUsuario) {
            $this->em->remove($mensajeUsuario);
        }

        $this->em->flush();

        return $mensaje;
    }

    public function getDestinatariosFromBorrador($borrador)
    {
        $mensajesUsuarios = $this->em->getRepository('BoletinesBundle:MensajeUsuario')->findBy([
            'mensaje' => $borrador
        ]);

        $destinatarios = [];

        foreach ($mensajesUsuarios as $mensajeUsuario) {
            $destinatarios[] = $mensajeUsuario->getUsuario();
        }

        return $destinatarios;
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
