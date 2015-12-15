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

    private function newNotificacion($title = null, $msg = null, $url = null)
    {
        $notificacion = new Notificacion();
        $notificacion->setTitulo($title);
        $notificacion->setTexto($msg);
        $notificacion->setUrl($url);
        $notificacion->setFechaEnvio(new \DateTime('now'));

        $this->em->persist($notificacion);
        $this->em->flush();

        return $notificacion;
    }

    private function newNotificacionUsuario($user, $notificacion)
    {
        $notificacionUsuario = new NotificacionUsuario();
        $notificacionUsuario->setUsuario($user);
        $notificacionUsuario->setNotificacion($notificacion);
        $notificacionUsuario->setNotificado(false);
        $notificacionUsuario->setCreationTime(new \DateTime('now'));
        $notificacionUsuario->setUpdateTime(new \DateTime('now'));

        $this->em->persist($notificacionUsuario);
        $this->em->flush();

        return $notificacionUsuario;
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

    public function readNotificacionesNoVistasByUser($user)
    {
        $notificacionesUsuario = $user->getNotificacionesNoVistas();

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

        $notificacion = $this->newNotificacion($titulo, $texto, $url);

        foreach($users as $user) {
            $this->newNotificacionUsuario($user, $notificacion);
        }
    }

    public function newCalificacionNotificacion($alumnos, $titulo = null, $texto = null, $url = null)
    {
        if (is_null($titulo)) {
            $titulo = "Notificacion de Calificacion";
        }

        foreach($alumnos as $alumno) {
            $notificacion = $this->newNotificacion($titulo . " para " . $alumno->getNombre(), $texto, $url);

            $this->newNotificacionUsuario($alumno->getUsuario(), $notificacion);

            if ($alumno->getPadre1()) {
                $this->newNotificacionUsuario($alumno->getPadre1()->getUsuario(), $notificacion);
            }
            if ($alumno->getPadre2()) {
                $this->newNotificacionUsuario($alumno->getPadre2()->getUsuario(), $notificacion);
            }
        }
    }

    public function newAsistenciaNotificacion($alumno, $titulo = null, $texto = null, $url = null)
    {
        if (is_null($titulo)) {
            $titulo = "Notificacion de Inasistencia";
        }

        $notificacion = $this->newNotificacion($titulo . " para " . $alumno->getNombre(), $texto, $url);

        if ($alumno->getPadre1()) {
            $this->newNotificacionUsuario($alumno->getPadre1()->getUsuario(), $notificacion);
        }
        if ($alumno->getPadre2()) {
            $this->newNotificacionUsuario($alumno->getPadre2()->getUsuario(), $notificacion);
        }
    }

    public function newConvivenciaNotificacion($alumno, $titulo = null, $texto = null, $url = null)
    {
        if (is_null($titulo)) {
            $titulo = "Notificacion de Convivencia";
        }

        $notificacion = $this->newNotificacion($titulo . " para " . $alumno->getNombre(), $texto, $url);

        if ($alumno->getPadre1()) {
            $this->newNotificacionUsuario($alumno->getPadre1()->getUsuario(), $notificacion);
        }
        if ($alumno->getPadre2()) {
            $this->newNotificacionUsuario($alumno->getPadre2()->getUsuario(), $notificacion);
        }
    }

    public function newActividadNotificacion($users, $titulo = null, $texto = null, $url = null)
    {
        if (is_null($titulo)) {
            $titulo = "Notificacion de Actividad";
        }

        $notificacion = $this->newNotificacion($titulo, $texto, $url);

        foreach ($users as $user) {
            $this->newNotificacionUsuario($user, $notificacion);
        }
    }

    public function newActividadMateriaNotificacion($alumnos, $titulo = null, $texto = null, $url = null)
    {
        if (is_null($titulo)) {
            $titulo = "Notificacion de Actividad";
        }

        foreach($alumnos as $alumno) {
            $notificacion = $this->newNotificacion($titulo . " para " . $alumno->getNombre(), $texto, $url);

            $this->newNotificacionUsuario($alumno->getUsuario(), $notificacion);

            if ($alumno->getPadre1()) {
                $this->newNotificacionUsuario($alumno->getPadre1()->getUsuario(), $notificacion);
            }
            if ($alumno->getPadre2()) {
                $this->newNotificacionUsuario($alumno->getPadre2()->getUsuario(), $notificacion);
            }
        }
    }
}
