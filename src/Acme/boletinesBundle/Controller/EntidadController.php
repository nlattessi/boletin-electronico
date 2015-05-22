<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Entidad;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\EntidadType;

class EntidadController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Entidad')->findAll();

        return $this->render('BoletinesBundle:Entidad:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entidad = $em->getRepository('BoletinesBundle:Entidad')->findOneBy(array('idEntidad' => $id));

        return $this->render('BoletinesBundle:Entidad:show.html.twig', array('entidad' => $entidad));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $entidad = $this->createEntity($request);
            if($entidad != null) {
                return $this->render('BoletinesBundle:Entidad:show.html.twig', array('entidad' => $entidad));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Entidad:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $entidad = new Entidad();
        $entidad->setNombreEntidad($data->request->get('nombreEntidad'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $entidad->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($entidad);
        $em->flush();

        return $entidad;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('BoletinesBundle:Entidad')->findOneBy(array('idEntidad' => $id));

        if($entidad instanceof Entidad) {
            $em->remove($entidad);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $entidad = $this->editEntity($request, $id);
            if($entidad != null) {
                return $this->render('BoletinesBundle:Entidad:show.html.twig', array('entidad' => $entidad));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $entidad = $em->getRepository('BoletinesBundle:Entidad')->findOneBy(array('idEntidad' => $id));
        }

        return $this->render('BoletinesBundle:Entidad:edit.html.twig', array('entidad' => $entidad, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('BoletinesBundle:Entidad')->findOneBy(array('idEntidad' => $id));

        $entidad->setNombreEntidad($data->request->get('nombreEntidad'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada != null || $idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $entidad->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($entidad);
        $em->flush();

        return $entidad;
    }
}

