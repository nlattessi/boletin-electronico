<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Notificacion;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\NotificacionType;

class NotificacionController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Notificacion')->findAll();

        return $this->render('BoletinesBundle:Notificacion:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $notificacion = $em->getRepository('BoletinesBundle:Notificacion')->findOneBy(array('idNotificacion' => $id));

        return $this->render('BoletinesBundle:Notificacion:show.html.twig', array('notificacion' => $notificacion));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $notificacion = $this->createEntity($request);
            if($notificacion != null) {
                return $this->render('BoletinesBundle:Notificacion:show.html.twig', array('notificacion' => $notificacion));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Notificacion:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $notificacion = new Notificacion();
        $notificacion->setNombreNotificacion($data->request->get('nombreNotificacion'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $notificacion->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($notificacion);
        $em->flush();

        return $notificacion;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $notificacion = $em->getRepository('BoletinesBundle:Notificacion')->findOneBy(array('idNotificacion' => $id));

        if($notificacion instanceof Notificacion) {
            $em->remove($notificacion);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $notificacion = $this->editEntity($request, $id);
            if($notificacion != null) {
                return $this->render('BoletinesBundle:Notificacion:show.html.twig', array('notificacion' => $notificacion));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $notificacion = $em->getRepository('BoletinesBundle:Notificacion')->findOneBy(array('idNotificacion' => $id));
        }

        return $this->render('BoletinesBundle:Notificacion:edit.html.twig', array('notificacion' => $notificacion, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $notificacion = $em->getRepository('BoletinesBundle:Notificacion')->findOneBy(array('idNotificacion' => $id));

        $notificacion->setNombreNotificacion($data->request->get('nombreNotificacion'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada != null || $idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $notificacion->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($notificacion);
        $em->flush();

        return $notificacion;
    }
}

