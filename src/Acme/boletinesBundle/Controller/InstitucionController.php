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
            if($this->createInstitucion($request)) {
                $message = "Institicion agragada";
            } else {
                $message = "Errores";
            }
        }

        return $this->render('BoletinesBundle:Institucion:new.html.twig', array('mensaje' => $message));
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

    private function createInstitucion($data)
    {
        $institucion = new Institucion();
        $institucion->setNombreInstitucion($data->request->get('name'));
        $institucion->setDireccionInstitucion($data->request->get('direccion'));
        $institucion->setEmailInstitucion($data->request->get('email'));
        $institucion->setTelefonoInstitucion($data->request->get('telefono'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($institucion);
        $em->flush();

        return $institucion->getIdInstitucion();
    }
}
