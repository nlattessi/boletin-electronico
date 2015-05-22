<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Justificacion;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\JustificacionType;

class JustificacionController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Justificacion')->findAll();

        return $this->render('BoletinesBundle:Justificacion:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $justificacion = $em->getRepository('BoletinesBundle:Justificacion')->findOneBy(array('idJustificacion' => $id));

        return $this->render('BoletinesBundle:Justificacion:show.html.twig', array('justificacion' => $justificacion));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $justificacion = $this->createEntity($request);
            if($justificacion != null) {
                return $this->render('BoletinesBundle:Justificacion:show.html.twig', array('justificacion' => $justificacion));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Justificacion:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $justificacion = new Justificacion();
        $justificacion->setNombreJustificacion($data->request->get('nombreJustificacion'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $justificacion->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($justificacion);
        $em->flush();

        return $justificacion;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $justificacion = $em->getRepository('BoletinesBundle:Justificacion')->findOneBy(array('idJustificacion' => $id));

        if($justificacion instanceof Justificacion) {
            $em->remove($justificacion);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $justificacion = $this->editEntity($request, $id);
            if($justificacion != null) {
                return $this->render('BoletinesBundle:Justificacion:show.html.twig', array('justificacion' => $justificacion));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $justificacion = $em->getRepository('BoletinesBundle:Justificacion')->findOneBy(array('idJustificacion' => $id));
        }

        return $this->render('BoletinesBundle:Justificacion:edit.html.twig', array('justificacion' => $justificacion, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $justificacion = $em->getRepository('BoletinesBundle:Justificacion')->findOneBy(array('idJustificacion' => $id));

        $justificacion->setNombreJustificacion($data->request->get('nombreJustificacion'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada != null || $idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $justificacion->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($justificacion);
        $em->flush();

        return $justificacion;
    }
}

