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
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Mensaje:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $mensaje = new Mensaje();
        $mensaje->setNombreMensaje($data->request->get('nombreMensaje'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 1){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $mensaje->setEntityRelacionada($entityRelacionada);
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
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('idMensaje' => $id));
        }

        return $this->render('BoletinesBundle:Mensaje:edit.html.twig', array('mensaje' => $mensaje, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('idMensaje' => $id));

        $mensaje->setNombreMensaje($data->request->get('nombreMensaje'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada != null || $idEntityRelacionada > 1){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $mensaje->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($mensaje);
        $em->flush();

        return $mensaje;
    }
}

