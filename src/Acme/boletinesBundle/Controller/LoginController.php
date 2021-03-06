<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;


class LoginController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $year = date('Y');
        $start = mktime(0, 0, 0, 1, 1, $year);
        $end = mktime(0, 0, 0, 12, 31, $year);
        $session->set('year', date('Y', $start));
        $session->set('startYear', date('Y-m-d H:i:s', $start));
        $session->set('endYear', date('Y-m-d H:i:s', $end));
        $session->set('historic', 'off');

        // obtiene el error de inicio de sesión si lo hay
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render(
            'BoletinesBundle:Login:login.html.twig',
            array(
                // último nombre de usuario ingresado
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function redirectAction()
    {
        $sessionService =  $this->get('boletines.servicios.sesion');
        if ($this->getUser()->getRol()->getNombre() == 'ROLE_PADRE'  ) {
            $padreService =  $this->get('boletines.servicios.padre');
            $session = $this->getRequest()->getSession();
            $sessionService->setearAlumnoSesionPadre($session, $this->getUser()->getIdEntidadAsociada());
            $hijos = $padreService->obtenerHijos($this->getUser()->getIdEntidadAsociada());
            $session->set('hijos',  $hijos);
        }
        else if( $this->getUser()->getRol()->getNombre() == 'ROLE_ALUMNO')
        {
            $session = $this->getRequest()->getSession();
            $sessionService->cambiarAlumnoSesion($session, $this->getUser()->getIdEntidadAsociada());
        }  else if ($this->getUser()->getRol()->getNombre() == 'ROLE_DIRECTIVO' or $this->getUser()->getRol()->getNombre() == 'ROLE_ADMINISTRATIVO') {
            //return $this->redirect($this->generateUrl('director'));
        }
        else if( $this->getUser()->getRol()->getNombre() == 'ROLE_DOCENTE')
        {
            $session = $this->getRequest()->getSession();
            $sessionService->setearDocenteSesion($session, $this->getUser()->getIdEntidadAsociada());
        }

        return $this->redirect($this->generateUrl('home'));
        /*if($this->getUser()->getRol()->getNombre() == 'ROLE_ADMIN') {
            return $this->redirect($this->generateUrl('home_admin'));
        } else if ($this->getUser()->getRol()->getNombre() == 'ROLE_PADRE') {
            return $this->redirect($this->generateUrl('home_father'));
        } else if ($this->getUser()->getRol()->getNombre() == 'ROLE_ALUMNO') {
            return $this->redirect($this->generateUrl('home_alumno'));
        } else if ($this->getUser()->getRol()->getNombre() == 'ROLE_DIRECTIVO') {
            return $this->redirect($this->generateUrl('home_directivo_alumnos'));
        }*/
    }

    public function cambiarHijoAction($id){
        $sessionService =  $this->get('boletines.servicios.sesion');
        $session = $this->getRequest()->getSession();
        $sessionService->cambiarAlumnoSesion($session, $id);

        return $this->redirect($this->generateUrl('home'));
    }
}
