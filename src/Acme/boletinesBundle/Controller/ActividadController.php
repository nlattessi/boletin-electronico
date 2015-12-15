<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\boletinesBundle\Entity\Actividad;

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

        if ($request->getMethod() == 'POST') {
            $actividad = $this->createEntity($request);
            if (!is_null($actividad)) {
                $this->get('session')->getFlashBag()->add('success', 'Nueva actividad carga con éxito');
                return $this->redirect($this->generateUrl('calendario'), 301);
            } else {
                $message = "Errores";
            }
        }

        $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();

        return $this->render('BoletinesBundle:Actividad:new.html.twig', ['establecimientos' => $establecimientos]);
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $actividadService =  $this->get('boletines.servicios.actividad');

        $actividad = $actividadService->crearActividad(
            $data->request->get('nombre'),
            $data->request->get('descripcion'),
            $data->request->get('fecha_inicio'),
            $data->request->get('hora_inicio'),
            $data->request->get('fecha_fin'),
            $data->request->get('hora_fin'),
            $this->getUser(),
            ($data->request->get('institucion_chk') == 'on' ? $this->getUser()->getInstitucion() : null), // institucion
            ($data->request->get('establecimiento_chk') == 'on' ? $em->getRepository('BoletinesBundle:Establecimiento')->find($data->request->get('establecimiento')) : null), // establecimiento
            null // materia
        );

        if (!empty($data->files->get('archivos'))) {
            foreach ($data->files->get('archivos') as $archivo) {
                if ($archivo != null) {
                  $archivoService =  $this->get('boletines.servicios.archivo');
                  $archivoService->createActividadArchivo($archivo, $this->getUser(), $actividad);
                }
            }
        }

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
       $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => 0));
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
        if( $idArchivo > 0){
            //no eligio ninguno
            //Selecciono otro Archivo, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:Archivo')->findOneBy(array('idArchivo' => $idArchivo));
            $actividad->setArchivo($entityRelacionada);
        }

        $em->persist($actividad);
        $em->flush();

        return $actividad;
    }

    public function getActividadByUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actividadService =  $this->get('boletines.servicios.actividad');

        $actividades = $actividadService->getActividadByUser($this->getUser());

        $data = [];
        foreach ($actividades as $actividad) {
            $item = [
                // 'id' => $actividad->getId(), /* NO ES NECESARIO */
                'title' => $actividad->getNombre(),
                // 'descripcion' => $actividad->getDescripcion(), /* FALTA DEFINICION */
                'start' => $actividad->getFechaHoraInicio()->format(\DateTime::ISO8601),
                'end' => $actividad->getFechaHoraFin()->format(\DateTime::ISO8601)
                // 'url' => '' /* FALTA DEFINICION */
            ];
            $data[] = $item;
        }

        return new Response(json_encode($data));
    }

}
