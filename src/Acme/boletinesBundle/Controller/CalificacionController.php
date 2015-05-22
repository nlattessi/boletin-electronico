<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Calificacion;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\CalificacionType;

class CalificacionController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Calificacion')->findAll();

        return $this->render('BoletinesBundle:Calificacion:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        return $this->render('BoletinesBundle:Calificacion:show.html.twig', array('calificacion' => $calificacion));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $calificacion = $this->createEntity($request);
            if($calificacion != null) {
                return $this->render('BoletinesBundle:Calificacion:show.html.twig', array('calificacion' => $calificacion));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Calificacion:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = new Calificacion();
        $calificacion->setNombreCalificacion($data->request->get('nombreCalificacion'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $calificacion->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($calificacion);
        $em->flush();

        return $calificacion;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        if($calificacion instanceof Calificacion) {
            $em->remove($calificacion);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $calificacion = $this->editEntity($request, $id);
            if($calificacion != null) {
                return $this->render('BoletinesBundle:Calificacion:show.html.twig', array('calificacion' => $calificacion));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));
        }

        return $this->render('BoletinesBundle:Calificacion:edit.html.twig', array('calificacion' => $calificacion, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        $calificacion->setNombreCalificacion($data->request->get('nombreCalificacion'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada != null || $idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $calificacion->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($calificacion);
        $em->flush();

        return $calificacion;
    }
}

