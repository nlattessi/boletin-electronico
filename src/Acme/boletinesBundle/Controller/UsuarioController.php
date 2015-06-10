<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
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

        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => $id));

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
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => $id));

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
        $entity = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => $id));
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'usuario' => $entity,
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => $id));

        $usuario->setNombreUsuario($data->request->get('nombreUsuario'));
        $usuario->setNombreUsuarioParaMostrar($data->request->get('nombreUsuarioParaMostrar'));
        $usuario->setPassword($data->request->get('password'));

        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('idRol' => $data->request->get('idRol')));
        $usuario->setRol($rol);        
        
        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }
}
