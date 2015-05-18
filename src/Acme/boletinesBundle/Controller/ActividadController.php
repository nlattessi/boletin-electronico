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
use Acme\boletinesBundle\Servicios\ActividadService;

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
        if($actividad->getArchivo() != null){
            $entitiesRelacionadas = array($actividad->getArchivo());
        }else{
            $entitiesRelacionadas = array();
        }
        return $this->render('BoletinesBundle:Actividad:show.html.twig', array('actividad' => $actividad, 'entitiesRelacionadas' => $entitiesRelacionadas));
    }

    public function newAction(Request $request)
    {
        $message = "";
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $actividad = $this->createEntity($request);
            if($actividad != null) {
                return $this->render('BoletinesBundle:Actividad:show.html.twig', array('actividad' => $actividad ));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Archivo')->findAll();
        }

        return $this->render('BoletinesBundle:Actividad:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas, 'mensaje' => $message));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');
        $actividadService =  $this->get('boletines.servicios.actividad');

        $idArchivo = $data->request->get('idArchivo');
        $archivo = null;
        if($idArchivo > 0) {
            $archivo = $em->getRepository('BoletinesBundle:Archivo')->findOneBy(array('idArchivo' => $idArchivo));
        }

        $actividad = $actividadService->crearActividad($data->request->get('nombreActividad'),
            $data->request->get('descripcionActividad')
            ,new \DateTime('now')
            ,new \DateTime('now'),
            $sesionService->obtenerUsuario(),
            $archivo);

        /*   $actividad->setFechaDesde($data->request->get('fechaDesdeActividad'));
             $actividad->setFechaHasta($data->request->get('fechaHastaActividad'));*/

        return $actividad;
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



    private function obtenerUsuario($em){
        //TODO: sacar una vez que tengaos login
       $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => 1));
       return $usuario;
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $actividad = $this->editEntity($request, $id);
            if($actividad != null) {
                return $this->render('BoletinesBundle:Actividad:show.html.twig', array('actividad' => $actividad));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Archivo')->findAll();
            $actividad = $em->getRepository('BoletinesBundle:Actividad')->findOneBy(array('idActividad' => $id));
        }

        return $this->render('BoletinesBundle:Actividad:edit.html.twig', array('actividad' => $actividad, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $actividad = $em->getRepository('BoletinesBundle:Actividad')->findOneBy(array('idActividad' => $id));

        $actividad->setNombreActividad($data->request->get('nombreActividad'));
        $actividad->setDescripcionActividad($data->request->get('descripcionActividad'));
        /*   $actividad->setFechaDesde($data->request->get('fechaDesdeActividad'));
             $actividad->setFechaHasta($data->request->get('fechaHastaActividad'));*/
     //   $actividad->setFechaDesde(new \DateTime('now'));
     //   $actividad->setFechaHasta(new \DateTime('now'));
        $actividad->setFechaCreacion(new \DateTime('now'));

        $idArchivo = $data->request->get('idArchivo');
        if( $idArchivo > 1){
            //no eligio ninguno
            //Selecciono otro Archivo, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:Archivo')->findOneBy(array('idArchivo' => $idArchivo));
            $actividad->setArchivo($entityRelacionada);
        }

        $em->persist($actividad);
        $em->flush();

        return $actividad;
    }

}

