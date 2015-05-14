<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Institucion;
use Acme\boletinesBundle\Form\InstitucionType;

class InstitucionController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Institucion')->findAll();

        return $this->render('BoletinesBundle:Institucion:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $id));

        return $this->render('BoletinesBundle:Institucion:show.html.twig', array('entity' => $entity));
    }

    public function newAction(Request $request)
    {
        $message = "";

        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $entidad = $this->createEntity($request);
            if($entidad != null) {
                return $this->render('BoletinesBundle:Institucion:show.html.twig', array('entity' => $entidad));
            } else {
                $message = "Errores";
            }
        }

        return $this->render('BoletinesBundle:Institucion:new.html.twig', array('mensaje' => $message));
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $entity = $this->editEntity($request, $id);
            if($entity != null) {
                return $this->render('BoletinesBundle:Institucion:show.html.twig', array('entity' => $entity));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $id));
        }

        return $this->render('BoletinesBundle:Institucion:edit.html.twig', array('entity' => $entity, 'mensaje' => $message));
    }


    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $id));

       if($institucion instanceof Institucion) {
           $em->remove($institucion);
           $em->flush();
       }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
        $institucion = new Institucion();
        $institucion->setNombreInstitucion($data->request->get('name'));
        $institucion->setDireccionInstitucion($data->request->get('direccion'));
        $institucion->setEmailInstitucion($data->request->get('email'));
        $institucion->setTelefonoInstitucion($data->request->get('telefono'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($institucion);
        $em->flush();

        return $institucion;
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $id));

        $institucion->setNombreInstitucion($data->request->get('name'));
        $institucion->setDireccionInstitucion($data->request->get('direccion'));
        $institucion->setEmailInstitucion($data->request->get('email'));
        $institucion->setTelefonoInstitucion($data->request->get('telefono'));

        $em->persist($institucion);
        $em->flush();

        return $institucion;
    }
}
