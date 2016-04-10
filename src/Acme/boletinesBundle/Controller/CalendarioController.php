<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Form\CalendarioType;

class CalendarioController extends Controller
{

    public function indexAction()
    {
        return $this->render('BoletinesBundle:Calendario:index.html.twig', array('css_active' => 'calendario',));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calendario = $em->getRepository('BoletinesBundle:Calendario')->findOneBy(array('idCalendario' => $id));

        return $this->render('BoletinesBundle:Calendario:show.html.twig', array('calendario' => $calendario, 'css_active' => 'calendario',));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $calendario = $this->createEntity($request);
            if($calendario != null) {
                return $this->render('BoletinesBundle:Calendario:show.html.twig', array('calendario' => $calendario,
                    'css_active' => 'calendario',));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Calendario:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $calendario = new Calendario();
        $calendario->setNombreCalendario($data->request->get('nombreCalendario'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $calendario->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($calendario);
        $em->flush();

        return $calendario;
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $calendario = $em->getRepository('BoletinesBundle:Calendario')->findOneBy(array('idCalendario' => $id));

        if($calendario instanceof Calendario) {
            $em->remove($calendario);
            $em->flush();
        }
        return $this->indexAction();
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $calendario = $this->editEntity($request, $id);
            if($calendario != null) {
                return $this->render('BoletinesBundle:Calendario:show.html.twig', array('calendario' => $calendario));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $calendario = $em->getRepository('BoletinesBundle:Calendario')->findOneBy(array('idCalendario' => $id));
        }

        return $this->render('BoletinesBundle:Calendario:edit.html.twig', array('calendario' => $calendario, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $calendario = $em->getRepository('BoletinesBundle:Calendario')->findOneBy(array('idCalendario' => $id));

        $calendario->setNombreCalendario($data->request->get('nombreCalendario'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $calendario->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($calendario);
        $em->flush();

        return $calendario;
    }
}
