<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Calificacion;
use Acme\boletinesBundle\Servicios\ActividadService;
use Acme\boletinesBundle\Servicios\SesionService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Evaluacion;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\EvaluacionType;

class EvaluacionController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Evaluacion')->findAll();

        return $this->render('BoletinesBundle:Evaluacion:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Evaluacion:show.html.twig', array('evaluacion' => $evaluacion));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $evaluacion = $this->createEntity($request);
            if($evaluacion != null) {
                return $this->render('BoletinesBundle:Evaluacion:show.html.twig', array('evaluacion' => $evaluacion));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Materia')->findAll();
        }

        return $this->render('BoletinesBundle:Evaluacion:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');
        $actividadService =  $this->get('boletines.servicios.actividad');

        $evaluacion = new Evaluacion();
        $evaluacion->setNombreEvaluacion($data->request->get('nombreEvaluacion'));
        // $fechaEvaluacion = $data->request->get('fechaEvaluacion');
        //hasta que no tengamos el controller de fechas no vale la pena formatear el string
        $evaluacion->setFechaEvaluacion(new \DateTime('now'));
        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono una Materia
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $idMateria));
            $evaluacion->setMateria($materia);
        }else{
            //error, no puede no tener materia
        }

        $usuario = $sesionService->obtenerUsuario();

        $evaluacion->setDocente($sesionService->obtenerMiEntidadRelacionada());
        $evaluacion->setActividad($actividadService->crearActividad($evaluacion->getNombreEvaluacion(),
            "Actividad automatica del evaluacion", $evaluacion->getFechaEvaluacion(),$evaluacion->getFechaEvaluacion(),
            $usuario, null));

        $em->persist($evaluacion);
        $em->flush();

        return $evaluacion;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));

        if($evaluacion instanceof Evaluacion) {
            $em->remove($evaluacion);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $evaluacion = $this->editEntity($request, $id);
            if($evaluacion != null) {

                return $this->render('BoletinesBundle:Evaluacion:show.html.twig', array('evaluacion' => $evaluacion));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
            $materiaService =  $this->get('boletines.servicios.materia');
            $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));

        }

        return $this->render('BoletinesBundle:Evaluacion:edit.html.twig', array('evaluacion' => $evaluacion, 'mensaje' => $message,));
    }

    public function calificarAction($id = null, Request $request = null){

        if ($request->getMethod() == 'POST') {
            $message = "Las calificaciones fueron cargadas correctamente";
            $em = $this->getDoctrine()->getManager();
            $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
            $materiaService =  $this->get('boletines.servicios.materia');
            $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));
            $calificacion = null;
            $calificaciones = array();
            foreach($evaluacion->getMateria()->getAlumnos() as $alumno){
                $calificacion = new Calificacion();
                $calificacion->setAlumno($alumno);
                $calificacion->setEvaluacion($evaluacion);
                $calificacion->setUsuarioCarga($this->getUser());
                $calificacion->setFecha($evaluacion->getFecha());
                $calificacion->setFechaCreacion(new \DateTime("NOW"));
                $calificacion->setValor($request->get($alumno->getId() . "cal"));
                $calificacion->setComentario($request->get($alumno->getId() . "com"));
                $em->persist($calificacion);
                array_push($calificaciones,$calificacion );
            }
            $em->flush();


            return $this->render('BoletinesBundle:Evaluacion:calificacion.html.twig',
                array('evaluacion' => $evaluacion,
                    'mensaje' => $message,
                    'calificaciones' => $calificaciones,));
        } else {
            $em = $this->getDoctrine()->getManager();
            $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
            $materiaService =  $this->get('boletines.servicios.materia');
            $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));

        }
        return $this->render('BoletinesBundle:Evaluacion:edit.html.twig', array('evaluacion' => $evaluacion, ));

    }

    public function recalificarAction($id = null, Request $request = null){

        $message = "Las calificaciones fueron actualizadas correctamente";
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));

        $calificacionService =  $this->get('boletines.servicios.calificacion');
        $calificaciones = $calificacionService->obtenerCalificacionesPorEvaluacion($id);

        foreach($calificaciones as $calificacion){
            //TODO: agregar el isset en el request por seguridad
            $calificacion->setUsuarioCarga($this->getUser());
            $calificacion->setFechaActualizacion(new \DateTime("NOW"));
            $calificacion->setValor($request->get($calificacion->getId() . "cal"));
            $calificacion->setComentario($request->get($calificacion->getId() . "com"));
            $em->persist($calificacion);
        }
        $em->flush();


        return $this->render('BoletinesBundle:Evaluacion:calificacion.html.twig',
            array('evaluacion' => $evaluacion,
                'mensaje' => $message,
                'calificaciones' => $calificaciones,));
    }


    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));

        $evaluacion->setNombreEvaluacion($data->request->get('nombreEvaluacion'));
       // $fechaEvaluacion = $data->request->get('fechaEvaluacion');
        //hasta que no tengamos el controller de fechas no vale la pena formatear el string
        $evaluacion->setFechaEvaluacion(new \DateTime('now'));

        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono otra Materia, hay que buscarla y persistirla
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $idMateria));
            $evaluacion->setMateria($materia);
        }

        $em->persist($evaluacion);
        $em->flush();

        return $evaluacion;
    }
}

