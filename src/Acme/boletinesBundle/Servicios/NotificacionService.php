<?php
/**
 * Created by PhpStorm.
 * User: fclarat@hotmail.com
 * Date: 18-May-15
 * Time: 11:49 AM
 */

namespace Acme\boletinesBundle\Servicios;

use Acme\boletinesBundle\Entity\Notificacion;
use Acme\boletinesBundle\Entity\NotificacionUsuario;
use Doctrine\ORM\EntityManager;


class NotificacionService
{

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Create new notification
     *
     * @param int $toId
     * @param string $title
     * @param string $msg
     * @param string $url
     * @return boolean
     */
    //public function newUserNotificacion($toId, $title = '', $msg = '', $url = '')
    public function newUserNotificacion($user, $title = null, $msg = null, $url = null)
    {

        // $user = $this->em->getRepository('BoletinesBundle:Usuario')
        //     ->findOneBy(array('id' => $toId));

        $date = new \DateTime('now');

        $notificacion = new Notificacion();
        $notificacion->setFechaEnvio($date);
        $notificacion->setTexto($msg);
        $notificacion->setTitulo($title);
        $notificacion->setUrl($url);

        $this->em->persist($notificacion);
        $this->em->flush();

        $notificacionUsuario = new NotificacionUsuario();
        $notificacionUsuario->setUsuario($user);
        $notificacionUsuario->setUpdateTime($date);
        $notificacionUsuario->setCreationTime($date);
        $notificacionUsuario->setNotificacion($notificacion);
        $notificacionUsuario->setNotificado(false);

        $this->em->persist($notificacionUsuario);
        $this->em->flush();
    }

    public function newGroupNotificacion($toGroupId, $title = '', $msg = '', $url = '')
    {

        $group = $this->em->getRepository('BoletinesBundle:GrupoUsuario')
            ->findOneBy(array('id' => $toGroupId));

        $groupUsers = $this->em->getRepository('BoletinesBundle:UsuarioGrupoUsuario')
            ->findBy(array('grupoUsuario' => $group));

        foreach ($groupUsers as $user) {
            $this->newUserNotificacion(
                $user->getUsuario()->getId(),
                $title,
                $msg,
                $url
            );
        }
    }

    public function readNotificacion($id)
    {
        $notificacion = $this->em->getRepository('BoletinesBundle:Notificacion')
            ->findOneBy(array('id' => $id));
        $notificacionUsuario = $this->em->getRepository('BoletinesBundle:NotificacionUsuario')
            ->findOneBy(array('notificacion' => $notificacion));

        if($notificacionUsuario instanceof NotificacionUsuario) {
            $notificacionUsuario->setNotificado(1);
            $this->em->persist($notificacionUsuario);
            $this->em->flush();
        }
    }

    public function readNotificacionByUser($user)
    {
        $notificacionesUsuario = $this->em->getRepository('BoletinesBundle:NotificacionUsuario')
            ->findBy(array('usuario' => $user));

        foreach($notificacionesUsuario as $notificacionUsuario) {
            $notificacionUsuario->setNotificado(1);
            $this->em->persist($notificacionUsuario);
            $this->em->flush();
        }
    }

    public function getNotificaciones($user)
    {
        $notificaciones = [];

        $notificacionesUsuario = $this->em->getRepository('BoletinesBundle:NotificacionUsuario')
            ->findBy(array('usuario' => $user));

        foreach ($notificacionesUsuario as $notificacionUsuario) {
            $notificaciones[] = $notificacionUsuario->getNotificacion();
        }

        return $notificaciones;
    }

    public function newBullyingNotificacion($users, $titulo = null, $texto = null, $url = null)
    {
        if (is_null($titulo)) {
            $titulo = "Notificacion de Bullying";
        }

        foreach($users as $user) {
            $this->newUserNotificacion($user, $titulo, $texto, $url);
        }
    }

    public function newCalificacionNotificacion($alumnos, $titulo = null, $texto = null, $url = null)
    {
        if (is_null($titulo)) {
            $titulo = "Notificacion de Calificacion";
        }

        foreach($alumnos as $alumno)
        {
            $this->newUserNotificacion($alumno->getUsuario(), $titulo, $texto, $url);
        }
    }
}
