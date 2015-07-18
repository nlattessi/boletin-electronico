<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Mensaje;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\MensajeType;

class MensajeController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Mensaje')->findAll();

        return $this->render('BoletinesBundle:Mensaje:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('idMensaje' => $id));

        return $this->render('BoletinesBundle:Mensaje:show.html.twig', array('mensaje' => $mensaje));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $mensaje = $this->createEntity($request);
            if($mensaje != null) {
                return $this->render('BoletinesBundle:Mensaje:show.html.twig', array('mensaje' => $mensaje));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
        }

        return $this->render('BoletinesBundle:Mensaje:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $mensaje = new Mensaje();
        $mensaje->setTituloMensaje($data->request->get('tituloMensaje'));
        $mensaje->setTextoMensaje($data->request->get('textoMensaje'));
        $mensaje->setUsuarioEnvia($sesionService->obtenerUsuario());
        $mensaje->setFechaEnvio(new \DateTime('now'));
        $mensaje->setBorrado(false);
        $idUsuario = $data->request->get('idUsuarioRecibe');
        if($idUsuario > 0){
            //Selecciono una Usuario
            $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuario));
            $mensaje->setUsuarioRecibe($usuario);
        }

        $em->persist($mensaje);
        $em->flush();

        return $mensaje;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('idMensaje' => $id));

        if($mensaje instanceof Mensaje) {
            $em->remove($mensaje);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $mensaje = $this->editEntity($request, $id);
            if($mensaje != null) {
                return $this->render('BoletinesBundle:Mensaje:show.html.twig', array('mensaje' => $mensaje));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('idMensaje' => $id));
        }

        return $this->render('BoletinesBundle:Mensaje:edit.html.twig', array('mensaje' => $mensaje,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('idMensaje' => $id));

        $mensaje->setTituloMensaje($data->request->get('tituloMensaje'));
        $mensaje->setTextoMensaje($data->request->get('textoMensaje'));
        $mensaje->setUsuarioEnvia($sesionService->obtenerUsuario());
        $mensaje->setFechaEnvio(new \DateTime('now'));
        $mensaje->setBorrado(false);

        $idUsuario = $data->request->get('idUsuarioRecibe');
        if($idUsuario > 0){
            //Selecciono otra Usuario, hay que buscarla y persistirla
            $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuario));
            $mensaje->setUsuarioRecibe($usuario);
        }

        $em->persist($mensaje);
        $em->flush();

        return $mensaje;
    }
}

