<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\CalendarioType;

class CalendarioController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Calendario')->findAll();

        return $this->render('BoletinesBundle:Calendario:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('BoletinesBundle:Calendario')->findOneBy(array('idCalendario' => $id));

        return $this->render('BoletinesBundle:Calendario:show.html.twig', array('calendario' => $usuario));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $calendario = $this->createEntity($request);
            if($calendario != null) {
                return $this->render('BoletinesBundle:Calendario:show.html.twig', array('calendario' => $calendario));
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();

        return $this->render('BoletinesBundle:Calendario:new.html.twig', array(
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
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

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $calendario = new Calendario();
        $calendario->setNombreCalendario($data->request->get('nombreCalendario'));

        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => $data->request->get('idUsuario')));

        $calendario->setUsuarioPropietario($usuario);

        $em->persist($calendario);
        $em->flush();

        return $calendario;
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
        $entity = $em->getRepository('BoletinesBundle:Calendario')->findOneBy(array('idCalendario' => $id));
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();

        return $this->render('BoletinesBundle:Calendario:edit.html.twig', array(
            'calendario' => $entity,
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $calendario = $em->getRepository('BoletinesBundle:Calendario')->findOneBy(array('idCalendario' => $id));

        $calendario->setNombreCalendario($data->request->get('nombreCalendario'));

        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => $data->request->get('idUsuario')));
        
        $calendario->setUsuarioPropietario($usuario);
        
        $em->persist($calendario);
        $em->flush();

        return $calendario;
    }
}
