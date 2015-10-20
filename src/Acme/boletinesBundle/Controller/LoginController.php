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
            $session = $this->getRequest()->getSession();
            $sessionService->setearAlumnoSesionPadre($session, $this->getUser()->getIdEntidadAsociada());
            $hijos = $sessionService->obtenerHijos($this->getUser()->getIdEntidadAsociada());
            $session->set('hijos',  $hijos);
        }
        if( $this->getUser()->getRol()->getNombre() == 'ROLE_ALUMNO')
        {
            $session = $this->getRequest()->getSession();
            $sessionService->cambiarAlumnoSesion($session, $this->getUser()->getIdEntidadAsociada());
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
