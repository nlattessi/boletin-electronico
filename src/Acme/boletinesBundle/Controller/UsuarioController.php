<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\UsuarioType;

class UsuarioController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Usuario')->findAll();

        return $this->render('BoletinesBundle:Usuario:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Usuario:show.html.twig', array('usuario' => $usuario));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $usuario = $this->createEntity($request);
            if($usuario != null) {
                return $this->render('BoletinesBundle:Usuario:show.html.twig', array('usuario' => $usuario));
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();

        return $this->render('BoletinesBundle:Usuario:new.html.twig', array(
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        if($usuario instanceof Usuario) {
            $em->remove($usuario);
            $em->flush();
        }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $usuario->setNombreUsuario($data->request->get('nombreUsuario'));
        $usuario->setNombreUsuarioParaMostrar($data->request->get('nombreUsuarioParaMostrar'));
        $usuario->setPassword($data->request->get('password'));

        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('idRol' => $data->request->get('idRol')));

        $usuario->setRol($rol);

        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $entity = $this->editEntity($request, $id);
            if($entity != null) {
                return $this->getOneAction($entity->getId());
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'usuario' => $entity,
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    public function resetPasswordAction($token = null)
    {
        if ($token == null) {
            return new RedirectResponse($this->generateUrl('login_index'));
        }

        $em = $this->getDoctrine()->getManager();
        $tokenEntity = $em->getRepository('BoletinesBundle:Token')->findOneBy(array('token' => $token));
        if($tokenEntity instanceof Token) {
            return $this->render('BoletinesBundle:Usuario:emailReset.html.twig', array('token' => $token));
        } else {
            $this->get('session')->getFlashBag()->add(
                'token',
                'Token no encontrado.'
            );
            return new RedirectResponse($this->generateUrl('login_index'));
        }
    }

    public function emailRecoveryPasswordAction()
    {
        return $this->render('BoletinesBundle:Usuario:emailRecover.html.twig');
    }

    public function doResetPasswordAction(Request $request)
    {
        $token = $request->request->get('token');
        $pass = $request->request->get('password');
        $em = $this->getDoctrine()->getManager();
        $tokenEntity = $em->getRepository('BoletinesBundle:Token')->findOneBy(array('token' => $token));

        if($tokenEntity instanceof Token) {
            $user = $tokenEntity->getUsuario();
            $user->setPassword($pass);
            $tokenEntity->setToken(null);
            $tokenEntity->setUsuario(null);
            $em->persist($user);
            $em->persist($tokenEntity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'token',
                'Password actualizado.'
            );
            return new RedirectResponse($this->generateUrl('login_index'));
        }

        $this->get('session')->getFlashBag()->add(
            'token',
            'Token no encontrado.'
        );
        return new RedirectResponse($this->generateUrl('login_index'));
    }

    public function sendEmailRecoveryPasswordAction(Request $request)
    {
        $email = $request->request->get('email');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('email' => $email));

        if($user instanceof Usuario) {
            $token = new Token();
            $token->setToken($email);
            $token->setUsuario($user);

            $expire = new \DateTime();
            $expire->modify('+1 hour');
            $token->setExpirationTime($expire);

            $em->persist($token);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Reset password')
                ->setFrom('help@communitas.com')
                ->setTo(array('n_lattessi@hotmail.com', 'fclarat@gmail.com', 'federico.gonzalezc@gmail.com')) //HARDCODEADO PARA TEST
                ->setBody('Para modificar tu password de Communitas ingresa a http://localhost:8000/usuario/resetpassword/' . $token->getToken()) //HARDCODEADO PARA TEST
            ;
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add(
                'token',
                'Email enviado.'
            );

            return new RedirectResponse($this->generateUrl('login_index'));
        }

        $this->get('session')->getFlashBag()->add(
            'token',
            'Usuario no encontrado.'
        );
        return new RedirectResponse($this->generateUrl('login_index'));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        $usuario->setNombreUsuario($data->request->get('nombreUsuario'));
        $usuario->setNombreUsuarioParaMostrar($data->request->get('nombreUsuarioParaMostrar'));
        $usuario->setPassword($data->request->get('password'));

        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('idRol' => $data->request->get('idRol')));
        $usuario->setRol($rol);

        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }

    public function new2Action()
    {
        return $this->render('BoletinesBundle:Usuario:new2.html.twig', array());
    }

    public function edit2Action()
    {
        return $this->render('BoletinesBundle:Usuario:edit2.html.twig', array());
    }
}
