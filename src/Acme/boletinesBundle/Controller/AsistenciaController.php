<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Asistencia;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\AsistenciaType;

class AsistenciaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Asistencia')->findAll();

        return $this->render('BoletinesBundle:Asistencia:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $asistencia = $em->getRepository('BoletinesBundle:Asistencia')->findOneBy(array('idAsistencia' => $id));

        return $this->render('BoletinesBundle:Asistencia:show.html.twig', array('asistencia' => $asistencia));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $asistencia = $this->createEntity($request);
            if($asistencia != null) {
                return $this->render('BoletinesBundle:Asistencia:show.html.twig', array('asistencia' => $asistencia));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Asistencia:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $asistencia = new Asistencia();
        $asistencia->setNombreAsistencia($data->request->get('nombreAsistencia'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $asistencia->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($asistencia);
        $em->flush();

        return $asistencia;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $asistencia = $em->getRepository('BoletinesBundle:Asistencia')->findOneBy(array('idAsistencia' => $id));

        if($asistencia instanceof Asistencia) {
            $em->remove($asistencia);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $asistencia = $this->editEntity($request, $id);
            if($asistencia != null) {
                return $this->render('BoletinesBundle:Asistencia:show.html.twig', array('asistencia' => $asistencia));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $asistencia = $em->getRepository('BoletinesBundle:Asistencia')->findOneBy(array('idAsistencia' => $id));
        }

        return $this->render('BoletinesBundle:Asistencia:edit.html.twig', array('asistencia' => $asistencia, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $asistencia = $em->getRepository('BoletinesBundle:Asistencia')->findOneBy(array('idAsistencia' => $id));

        $asistencia->setNombreAsistencia($data->request->get('nombreAsistencia'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $asistencia->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($asistencia);
        $em->flush();

        return $asistencia;
    }
}

