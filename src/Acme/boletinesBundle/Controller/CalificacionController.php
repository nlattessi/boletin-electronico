<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Calificacion;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\CalificacionType;

class CalificacionController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()->getRol()->getNombre() == 'ROLE_PADRE' ||
            $this->getUser()->getRol()->getNombre() == 'ROLE_ALUMNO'){
            $request = $this->getRequest();
            $session = $request->getSession();
            $alumno = $session->get('alumnoActivo');

            if($alumno){
                $calificacionService =  $this->get('boletines.servicios.calificacion');
                $entities = $calificacionService->obtenerCalificaciones($alumno->getId());
            }else{
                return $this->render('BoletinesBundle:Calificacion:index.html.twig', array('entities' => null,
                    'mensaje' => "Usted no tiene hijos asociados, consulte con el administrador",
                    'css_active' => 'calificacion',));
            }
        }else{
            $entities = $em->getRepository('BoletinesBundle:Calificacion')->findAll();
        }


        return $this->render('BoletinesBundle:Calificacion:index.html.twig', array('entities' => $entities,
            'css_active' => 'calificacion',));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        return $this->render('BoletinesBundle:Calificacion:show.html.twig', array('calificacion' => $calificacion,
            'css_active' => 'calificacion',));
    }

    public function newAction($id = null,Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $em = $this->getDoctrine()->getManager();
            $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
            $materiaService =  $this->get('boletines.servicios.materia');
            $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));
            $calificacion = null;
            foreach($evaluacion->getMateria()->getAlumnos() as $alumno){
                $calificacion = new Calificacion();
                $calificacion->setAlumno($alumno);
                $calificacion->setEvaluacion($evaluacion);
                $calificacion->setUsuarioCarga($this->getUser());
                $calificacion->setFecha($evaluacion->getFecha());
                $calificacion->setFechaCreacion(date('d-m-Y h:i:s'));
                $calificacion->setValor($request->get($alumno->getId() . "cal"));
                $calificacion->setComentario($request->get($alumno->getId() . "com"));
                $em->persist($calificacion);
            }
            $em->flush();
            return $this->render('BoletinesBundle:Evaluacion:show.html.twig', array('evaluacion' => $evaluacion,
                'css_active' => 'materia',));
        }else{
            //no lo llama nunca por ahora, fail safe
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Evaluacion')->findAll();
            $alumnosDelEvaluacion = $em->getRepository('BoletinesBundle:Alumno')->findAll();
        }

        return $this->render('BoletinesBundle:Calificacion:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas,
            'alumnosDelEvaluacion' => $alumnosDelEvaluacion,
            'css_active' => 'materia',));
    }
    private function createEntity($id = null, Request $request = null)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
        $materiaService =  $this->get('boletines.servicios.materia');
        $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));
        $calificacion = null;
        foreach($evaluacion->getMateria()->getAlumnos() as $alumno){
            $calificacion = new Calificacion();
            $calificacion->setAlumno($alumno);
            $calificacion->setEvaluacion($evaluacion);
            $calificacion->setUsuarioCarga($this->getUser());
            $calificacion->setFecha($evaluacion->getFecha());
            $calificacion->setFechaCreacion(date('d-m-Y h:i:s'));
            $calificacion->setValor($request->get($alumno->getId() . "cal"));
            $calificacion->setComentario($request->get($alumno->getId() . "com"));
            $em->persist($calificacion);
        }
        $em->flush();

        return $calificacion;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        if($calificacion instanceof Calificacion) {
            $em->remove($calificacion);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $calificacion = $this->editEntity($request, $id);
            if($calificacion != null) {
                return $this->render('BoletinesBundle:Calificacion:show.html.twig', array('calificacion' => $calificacion));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Evaluacion')->findAll();
            $alumnosDelEvaluacion = $em->getRepository('BoletinesBundle:Alumno')->findAll();
            $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));
        }

        return $this->render('BoletinesBundle:Calificacion:edit.html.twig', array('calificacion' => $calificacion,
            'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas,
            'alumnosDelEvaluacion' => $alumnosDelEvaluacion,
            'css_active' => 'materia',));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        $calificacion->setValorCalificacion($data->request->get('valorCalificacion'));
        $calificacion->setComentarioCalificacion($data->request->get('comentarioCalificacion'));
        $calificacion->setFechaCalificacion(new \DateTime('now'));

        $idEvaluacion = $data->request->get('idEvaluacion');
        if($idEvaluacion > 0){
            //Selecciono otra Evaluacion, hay que buscarla y persistirla
            $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('idEvaluacion' => $idEvaluacion));
            $calificacion->setEvaluacion($evaluacion);
        }
        $idAlumno = $data->request->get('idAlumno');
        if($idAlumno > 0){
            //Selecciono una Alumno
            $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $idAlumno));
            $calificacion->setAlumno($alumno);
        }

        $em->persist($calificacion);
        $em->flush();

        return $calificacion;
    }
}

