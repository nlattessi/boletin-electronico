<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Establecimiento;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\EstablecimientoType;

class EstablecimientoController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Establecimiento')->findAll();

        return $this->render('BoletinesBundle:Establecimiento:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('idEstablecimiento' => $id));

        return $this->render('BoletinesBundle:Establecimiento:show.html.twig', array('entity' => $establecimiento));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $establecimiento = $this->createEntity($request);
            if($establecimiento != null) {
                return $this->render('BoletinesBundle:Establecimiento:show.html.twig', array('entity' => $establecimiento));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $instituciones = $em->getRepository('BoletinesBundle:Institucion')->findAll();
        }

        return $this->render('BoletinesBundle:Establecimiento:new.html.twig', array('instituciones' => $instituciones));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('idEstablecimiento' => $id));

        if($establecimiento instanceof Establecimiento) {
            $em->remove($establecimiento);
            $em->flush();
        }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $establecimiento = new Establecimiento();
        $establecimiento->setNombreEstablecimiento($data->request->get('nombreEstablecimiento'));
        $establecimiento->setDireccionEstablecimiento($data->request->get('direccionEstablecimiento'));
        $establecimiento->setEmailEstablecimiento($data->request->get('emailEstablecimiento'));
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $data->request->get('idInstitucion')));
        $establecimiento->setIdInstitucion($institucion);

        $em->persist($establecimiento);
        $em->flush();

        return $establecimiento;
    }
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->find($id);

        if (!$establecimiento) {
            throw $this->createNotFoundException('Unable to find Establecimiento entity.');
        }

        $editForm = $this->createEditForm($establecimiento);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'entity'      => $establecimiento,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}

