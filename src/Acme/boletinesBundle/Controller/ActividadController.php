<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Actividad;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\ActividadType;

class ActividadController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Actividad')->findAll();

        return $this->render('BoletinesBundle:Actividad:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $actividad = $em->getRepository('BoletinesBundle:Actividad')->findOneBy(array('idActividad' => $id));

        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Archivo')->findBy(array('idArchivo' => $actividad->getArchivo()));
        return $this->render('BoletinesBundle:Actividad:show.html.twig', array('entity' => $actividad, 'archivos' => $entitiesRelacionadas));
    }

    public function newAction(Request $request)
    {
        $message = "";
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $actividad = $this->createEntity($request);
            if($actividad != null) {
                $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Archivo')->findBy(array('idArchivo' => $actividad->getArchivo()));
                return $this->render('BoletinesBundle:Actividad:show.html.twig', array('entity' => $actividad,'archivos' => $entitiesRelacionadas ));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Archivo')->findAll();
        }

        return $this->render('BoletinesBundle:Actividad:new.html.twig', array('archivos' => $entitiesRelacionadas, 'mensaje' => $message));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $actividad = $em->getRepository('BoletinesBundle:Actividad')->findOneBy(array('idActividad' => $id));

        if($actividad instanceof Actividad) {
            $em->remove($actividad);
            $em->flush();
        }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $actividad = new Actividad();
        $actividad->setNombreActividad($data->request->get('nombreActividad'));
        $actividad->setDescripcionActividad($data->request->get('descripcionActividad'));
   /*   $actividad->setFechaDesde($data->request->get('fechaDesdeActividad'));
        $actividad->setFechaHasta($data->request->get('fechaHastaActividad'));*/
        $actividad->setFechaDesde(new \DateTime('now'));
        $actividad->setFechaHasta(new \DateTime('now'));
        $actividad->setFechaCreacion(new \DateTime('now'));

        $actividad->setUsuarioCreador($this->obtenerUsuario($em));

        $idArchivo = $data->request->get('idArchivo');
        if($idArchivo > 0) {
            $archivo = $em->getRepository('BoletinesBundle:Archivo')->findOneBy(array('idArchivo' => $idArchivo));
            $actividad->setArchivo($archivo);
        }
        $em->persist($actividad);
        $em->flush();

        return $actividad;
    }

    private function obtenerUsuario($em){
        //TODO: sacar una vez que tengaos login
       $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => 1));
       return $usuario;
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $actividad = $em->getRepository('BoletinesBundle:Actividad')->find($id);

        if (!$actividad) {
            throw $this->createNotFoundException('Unable to find Actividad entity.');
        }

        $editForm = $this->createEditForm($actividad);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'entity'      => $actividad,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}

