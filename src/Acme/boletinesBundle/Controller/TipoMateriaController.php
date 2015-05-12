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

class TipoMateriaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:TipoMateria')->findAll();

        return $this->render('BoletinesBundle:TipoMateria:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $id));

        return $this->render('BoletinesBundle:TipoMateria:show.html.twig', array('entity' => $tipoMateria));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $tipoMateria = $this->createEntity($request);
            if($tipoMateria != null) {
                return $this->render('BoletinesBundle:TipoMateria:show.html.twig', array('entity' => $tipoMateria));
            } else {
                $message = "Errores";
            }
        }

        return $this->render('BoletinesBundle:TipoMateria:new.html.twig', array('mensaje' => $message));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $id));

        if($tipoMateria instanceof TipoMateria) {
            $em->remove($tipoMateria);
            $em->flush();
        }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();


        $tipoMateria = new TipoMateria();
        $tipoMateria->setNombreTipoMateria($data->request->get('nombre'));

        $em->persist($tipoMateria);
        $em->flush();

        return $tipoMateria;
    }
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->find($id);

        if (!$tipoMateria) {
            throw $this->createNotFoundException('Unable to find TipoMateria entity.');
        }

        $editForm = $this->createEditForm($tipoMateria);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'entity'      => $tipoMateria,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
