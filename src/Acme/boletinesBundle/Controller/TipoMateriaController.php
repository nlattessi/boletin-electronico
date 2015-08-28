<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\TipoMateria;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\TipoMateriaType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TipoMateriaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        // $entities = $em->getRepository('BoletinesBundle:TipoMateria')->findAll();
        // $tiposMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findBy(array(
        //     'establecimiento' => $this->getUser()->getInstitucion()
        // ));

        $tiposMateria = [];
        $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();

        foreach ($establecimientos as $establecimiento) {
            foreach ($establecimiento->getTiposMateria() as $tipoMateria) {
                $tiposMateria[] = $tipoMateria;
            }
        }

        // return $this->render('BoletinesBundle:TipoMateria:index.html.twig', array('entities' => $entities));
        return $this->render('BoletinesBundle:TipoMateria:index2.html.twig', array(
            'institucion' => $this->getUser()->getInstitucion(),
            'tiposMateria' => $tiposMateria
        ));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $id));

        return $this->render('BoletinesBundle:TipoMateria:show.html.twig', array('tipoMateria' => $tipoMateria));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $tipoMateria = $this->createEntity($request);
            if($tipoMateria != null) {
                // return $this->render('BoletinesBundle:TipoMateria:show.html.twig', array('tipoMateria' => $tipoMateria));
                return new RedirectResponse($this->generateUrl('tipoMateria', array()));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $establecimientos = $em->getRepository('BoletinesBundle:Establecimiento')->findBy(array(
                'institucion' => $this->getUser()->getInstitucion()
            ));
        }

        return $this->render('BoletinesBundle:TipoMateria:new2.html.twig', array(
            'mensaje' => $message,
            'establecimientos' => $establecimientos
        ));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $tipoMateria = new TipoMateria();
        $tipoMateria->setNombre($data->request->get('nombre'));

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $tipoMateria->setEstablecimiento($establecimiento);

        $em->persist($tipoMateria);
        $em->flush();

        return $tipoMateria;
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('id' => $id));

        if($tipoMateria instanceof TipoMateria) {
            $em->remove($tipoMateria);
            $em->flush();
        }

        return new RedirectResponse($this->generateUrl('tipoMateria', array()));
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $tipoMateria = $this->editEntity($request, $id);
            if($tipoMateria != null) {
                return $this->render('BoletinesBundle:TipoMateria:show.html.twig', array('tipoMateria' => $tipoMateria));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $id));
        }

        return $this->render('BoletinesBundle:TipoMateria:edit.html.twig', array('tipoMateria' => $tipoMateria, 'mensaje' => $message));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $id));

        $tipoMateria->setNombreTipoMateria($data->request->get('nombreTipoMateria'));

        $em->persist($tipoMateria);
        $em->flush();

        return $tipoMateria;
    }
}
