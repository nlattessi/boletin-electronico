<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Establecimiento:show.html.twig', array('establecimiento' => $establecimiento));
    }

    public function newWithInstitucionAction($institucionId, Request $request)
    {
        $error = "";

        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca

            $em = $this->getDoctrine()->getManager();
            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $institucionId));

            $creacionService =  $this->get('boletines.servicios.creacion');
            $establecimiento = $creacionService->crearEstablecimiento($request, $institucion);

            if ($establecimiento != null) {

                if ($request->request->has("finalizar")){
                    return new RedirectResponse($this->generateUrl('institucion_show', array('id' => $institucion->getId())));
                } else{
                    return new RedirectResponse($this->generateUrl('establecimiento_new_with_institucion', array('institucionId' => $institucion->getId())));
                }

            } else {
                $error = "Errores";
            }

        } else {
            $em = $this->getDoctrine()->getManager();
            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $institucionId));
        }

        return $this->render('BoletinesBundle:Establecimiento:new_with_institucion.html.twig', array('institucionId' => $institucionId, 'error' => $error));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));

        $institucion = $establecimiento->getInstitucion();

        if ($establecimiento instanceof Establecimiento) {
            $em->remove($establecimiento);
            $em->flush();
        }

        return new RedirectResponse($this->generateUrl('institucion_show', array('id' => $institucion->getId())));
    }

    public function editAction($id = null, Request $request = null)
    {
        $error = "";

        if ($request->getMethod() == 'POST') {
            $creacionService =  $this->get('boletines.servicios.creacion');
            $establecimiento = $creacionService->editarEstablecimiento($request, $id);

            if ($establecimiento != null) {
                return new RedirectResponse($this->generateUrl('establecimiento_show', array('id' => $establecimiento->getId())));
            } else {
                $error = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));
        }

        return $this->render('BoletinesBundle:Establecimiento:edit.html.twig', array('establecimiento' => $establecimiento, 'error' => $error));
    }
}
