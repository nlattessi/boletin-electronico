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
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $establecimiento->getInstitucion()));
        $establecimiento->setInstitucion($institucion);
        return $this->render('BoletinesBundle:Establecimiento:show.html.twig', array('establecimiento' => $establecimiento));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $establecimiento = $this->createEntity($request);
            if($establecimiento != null) {
                return $this->render('BoletinesBundle:Establecimiento:show.html.twig', array('establecimiento' => $establecimiento));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Institucion')->findAll();
        }

        return $this->render('BoletinesBundle:Establecimiento:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $establecimiento = new Establecimiento();
        $establecimiento->setNombreEstablecimiento($data->request->get('nombreEstablecimiento'));
        $establecimiento->setDireccionEstablecimiento($data->request->get('direccionEstablecimiento'));
        $establecimiento->setEmailEstablecimiento($data->request->get('emailEstablecimiento'));
        $establecimiento->setTelefonoEstablecimiento($data->request->get('telefonoEstablecimiento'));
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $data->request->get('idInstitucion')));
        $establecimiento->setInstitucion($institucion);

        $em->persist($establecimiento);
        $em->flush();

        return $establecimiento;
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


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $establecimiento = $this->editEntity($request, $id);
            if($establecimiento != null) {
                return $this->render('BoletinesBundle:Establecimiento:show.html.twig', array('establecimiento' => $establecimiento));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Institucion')->findAll();
            $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('idEstablecimiento' => $id));
        }

        return $this->render('BoletinesBundle:Establecimiento:edit.html.twig', array('establecimiento' => $establecimiento, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('idEstablecimiento' => $id));

        $establecimiento->setNombreEstablecimiento($data->request->get('nombreEstablecimiento'));
        $establecimiento->setDireccionEstablecimiento($data->request->get('direccionEstablecimiento'));
        $establecimiento->setEmailEstablecimiento($data->request->get('emailEstablecimiento'));
        $establecimiento->setTelefonoEstablecimiento($data->request->get('telefonoEstablecimiento'));

        $idInstitucion = $data->request->get('idInstitucion');
        if($idInstitucion > 1){
            //Selecciono otra Institucion, hay que buscarla y persistirla
            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('idInstitucion' => $idInstitucion));
            $establecimiento->setInstitucion($institucion);
        }

        $em->persist($establecimiento);
        $em->flush();

        return $establecimiento;
    }
}

