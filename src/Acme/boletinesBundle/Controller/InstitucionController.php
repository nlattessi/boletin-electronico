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

        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $id));

        return $this->render('BoletinesBundle:Institucion:show.html.twig', array('institucion' => $institucion));
    }

    public function newAction(Request $request)
    {
        $message = "";

        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $institucion = $this->createEntity($request);
            if($institucion != null) {
                return $this->render('BoletinesBundle:Institucion:show.html.twig', array('institucion' => $institucion));
            } else {
                $message = "Errores";
            }
        }

        return $this->render('BoletinesBundle:Institucion:new.html.twig', array('mensaje' => $message));
    }

    private function createEntity($data)
    {
        $institucion = new Institucion();
        $institucion->setNombreInstitucion($data->request->get('nombreInstitucion'));
        $institucion->setDireccionInstitucion($data->request->get('direccionInstitucion'));
        $institucion->setEmailInstitucion($data->request->get('emailInstitucion'));
        $institucion->setTelefonoInstitucion($data->request->get('telefonoInstitucion'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($institucion);
        $em->flush();

        return $institucion;
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


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $institucion = $this->editEntity($request, $id);
            if($institucion != null) {
                return $this->render('BoletinesBundle:Institucion:show.html.twig', array('institucion' => $institucion));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $id));
        }

        return $this->render('BoletinesBundle:Institucion:edit.html.twig', array('institucion' => $institucion, 'mensaje' => $message));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $id));

        $institucion->setNombreInstitucion($data->request->get('nombreInstitucion'));
        $institucion->setDireccionInstitucion($data->request->get('direccionInstitucion'));
        $institucion->setEmailInstitucion($data->request->get('emailInstitucion'));
        $institucion->setTelefonoInstitucion($data->request->get('telefonoInstitucion'));

        $em->persist($institucion);
        $em->flush();

        return $institucion;
    }
}
