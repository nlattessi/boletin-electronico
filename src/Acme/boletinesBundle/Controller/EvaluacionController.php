<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Calificacion;
use Acme\boletinesBundle\Servicios\ActividadService;
use Acme\boletinesBundle\Servicios\SesionService;
use Acme\boletinesBundle\Utils\Herramientas;
use Doctrine\Common\Collections\ArrayCollection;
use Proxies\__CG__\Acme\boletinesBundle\Entity\Materia;
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

        return $this->render('BoletinesBundle:Evaluacion:index.html.twig', array('entities' => $entities,'css_active' => 'materia',));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Evaluacion:show.html.twig', array('evaluacion' => $evaluacion,'css_active' => 'materia',));
    }

    public function newAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $evaluacion = $this->createEntity($request);
            if($evaluacion != null) {
                // return $this->render('BoletinesBundle:Evaluacion:show.html.twig', array('evaluacion' => $evaluacion,
                //     'css_active' => 'materia',));
                return $this->redirect($this->generateUrl('evaluacion_show', ['id' => $evaluacion->getId()]), 301);
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));
            $materiaService =  $this->get('boletines.servicios.materia');
            $materia->setGruposAlumnos($materiaService->listaGruposAlumnoPorMateria($id));

            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimiento = $this->getRequest()->getSession()->get('establecimientoActivo');
            $periodos = $muchosAMuchos->obtenerPeriodosPorEstablecimiento($establecimiento);
        }

        return $this->render('BoletinesBundle:Evaluacion:new.html.twig', [
            'materia' => $materia,
            'css_active' => 'materia',
            'periodos' => $periodos
        ]);
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');
        $actividadService =  $this->get('boletines.servicios.actividad');

        $evaluacion = new Evaluacion();
        $evaluacion->setNombre($data->request->get('nombre'));

        $fecha = $data->request->get('fecha');
        $hora = $data->request->get('hora');
        $fecha = Herramientas::fechaHoraADatetime($fecha, $hora);


        $evaluacion->setFecha($fecha);

        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono una Materia
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $idMateria));
            $materiaService =  $this->get('boletines.servicios.materia');
            $materia->setGruposAlumnos($materiaService->listaGruposAlumnoPorMateria($idMateria));
            $evaluacion->setMateria($materia);
        }else{
            //error, no puede no tener materia
        }

        $usuario = $sesionService->obtenerUsuario();
        $request = $this->getRequest();
        $session = $request->getSession();
        $docente = $session->get('docenteActivo');
        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('id' => $docente->getId()));
        $evaluacion->setDocente($docente);//TODO: chequear que onda esto
        $evaluacion->setCalificada(false);
        /*
        $evaluacion->setActividad($actividadService->crearActividad($evaluacion->getNombre(),
            "Actividad automatica del evaluacion", $evaluacion->getFecha(),$evaluacion->getFecha(),
            $usuario, null));*/
        $actividad = $actividadService->crearActividad(
            $evaluacion->getNombre('nombre'),
            "Actividad automatica de evaluacion",
            $evaluacion->getFecha()->format('d/m/Y'),
            "9:00 AM", /* HARDCODEADA SE DEBE CAMBIAR */
            $evaluacion->getFecha()->format('d/m/Y'),
            "11:00 AM", /* HARDCODEADA SE DEBE CAMBIAR */
            $this->getUser(),
            null, // institucion
            null, // establlecimiento
            $materia
        );

        $periodo = $em->getRepository('BoletinesBundle:Periodo')->find($data->request->get('periodo'));
        if ($periodo) {
            $evaluacion->setPeriodo($periodo);
        }

        $em->persist($evaluacion);
        $em->flush();

        if (!empty($data->files->get('archivos'))) {
            foreach ($data->files->get('archivos') as $archivo) {
                if (!is_null($archivo)) {
                    $archivoService =  $this->get('boletines.servicios.archivo');
                    $archivoService->createEvaluacionArchivo($archivo, $usuario, $evaluacion);
                }
            }
        }

        // Envio notificaciones
        $notificacionService = $this->get('boletines.servicios.notificacion');
        $alumnos = $materiaService->listaAlumnos($materia);
        $notificacionService->newActividadMateriaNotificacion(
            $alumnos,
            "Nueva actividad de evaluación creada",
            "Se creó una actividad para la evaluacíón " . $evaluacion->getNombre() . " de la materia " . $materia->getNombre(),
            $this->generateUrl('evaluacion_show', ['id' => $evaluacion->getId()])
        );

        return $evaluacion;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
        $materia = $evaluacion->getMateria();
        if($evaluacion instanceof Evaluacion) {
            $bajaAdministrativaService = $this->get('boletines.servicios.bajaAdministrativa');
            $bajaAdministrativaService->darDeBaja($evaluacion);
           // $em->remove($evaluacion);
           // $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $evaluacion = $this->editEntity($request, $id);
            if($evaluacion != null) {

                // return $this->render('BoletinesBundle:Evaluacion:show.html.twig', array('evaluacion' => $evaluacion,
                //     'css_active' => 'materia',));
                return $this->redirect($this->generateUrl('evaluacion_show', ['id' => $id]), 301);
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
           // $materiaService =  $this->get('boletines.servicios.materia');
           // $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));

           $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
           $establecimiento = $this->getRequest()->getSession()->get('establecimientoActivo');
           $periodos = $muchosAMuchos->obtenerPeriodosPorEstablecimiento($establecimiento);

        }

        return $this->render('BoletinesBundle:Evaluacion:edit.html.twig', [
            'evaluacion' => $evaluacion,
            'mensaje' => $message,
            'css_active' => 'materia',
            'periodos' => $periodos
          ]);
    }

    public function calificarAction($id = null, Request $request = null){

        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
        if($evaluacion->isCalificada()) {
            //ya califiqué alguna vez, le voy a dar una lista de calificaciones
            return $this->recalificar($evaluacion, $request);
        }

        $request = $this->getRequest();
        $session = $request->getSession();
        $establecimiento = $session->get('establecimientoActivo');
        $calificacionService =  $this->get('boletines.servicios.calificacion');
        $valoresCalificacion = $calificacionService->valoresAceptados($establecimiento);

        if ($request->getMethod() == 'POST') {
            $message = "Las calificaciones fueron cargadas correctamente";

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
                $valorId = $request->get($alumno->getId() . "cal");
                $calificacion->setValor($em->getRepository('BoletinesBundle:ValorCalificacion')->findOneBy(array('id' => $valorId)));
                $calificacion->setComentario($request->get($alumno->getId() . "com"));
                $em->persist($calificacion);
                array_push($calificaciones,$calificacion );
            }
            $evaluacion->setCalificada(true);
            $em->flush();

            // Envio notificaciones
            $notificacionService = $this->get('boletines.servicios.notificacion');
            $notificacionService->newCalificacionNotificacion(
                $evaluacion->getMateria()->getAlumnos(),
                "Calificacion cargada en " . $evaluacion->getMateria(),
                "Se cargaron las calificaciones para la evaluación " . $evaluacion->getNombre(),
                $this->generateUrl('calificacion')
            );

            return $this->render('BoletinesBundle:Evaluacion:calificacion.html.twig',
                array('evaluacion' => $evaluacion,
                    'mensaje' => $message,
                    'calificaciones' => $calificaciones,
                    'valoresCalificacion' => $valoresCalificacion,
                    'css_active' => 'materia',));
        } else {
            //Primera vez que entro a calificar, no hay calificaciones le voy a dar una lista de alumnos
            $materiaService =  $this->get('boletines.servicios.materia');
            $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));
        }
        return $this->render('BoletinesBundle:Evaluacion:calificacion.html.twig', array('evaluacion' => $evaluacion,
            'valoresCalificacion' => $valoresCalificacion,
            'css_active' => 'materia',));

    }

    public function recalificar($evaluacion, Request $request = null){

        $message = "";
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $establecimiento = $session->get('establecimientoActivo');

        $calificacionService =  $this->get('boletines.servicios.calificacion');
        $valoresCalificacion = $calificacionService->valoresAceptados($establecimiento);
        $calificaciones = $calificacionService->obtenerCalificacionesPorEvaluacion($evaluacion->getId());
        if ($request->getMethod() == 'POST') {
            $message = "Las calificaciones fueron actualizadas correctamente";
            foreach ($calificaciones as $calificacion) {
                //TODO: agregar el isset en el request por seguridad
                $calificacion->setUsuarioCarga($this->getUser());
                $calificacion->setFechaActualizacion(new \DateTime("NOW"));
                $valorId = $request->get($calificacion->getId() . "cal");
                $calificacion->setValor($em->getRepository('BoletinesBundle:ValorCalificacion')->findOneBy(array('id' => $valorId)));

                $calificacion->setComentario($request->get($calificacion->getId() . "com"));
                $em->persist($calificacion);
            }
            $em->flush();

            // Envio notificaciones
            $materiaService =  $this->get('boletines.servicios.materia');
            $evaluacion->getMateria()->setAlumnos($materiaService->listaAlumnos($evaluacion->getMateria()->getId()));
            $notificacionService = $this->get('boletines.servicios.notificacion');
            $notificacionService->newCalificacionNotificacion(
                $evaluacion->getMateria()->getAlumnos(),
                "Calificacion actualizada en " . $evaluacion->getMateria(),
                "Se actualizaron las calificaciones para la evaluación " . $evaluacion->getNombre(),
                $this->generateUrl('calificacion')
            );
        }


        return $this->render('BoletinesBundle:Evaluacion:calificacion.html.twig',
            array('evaluacion' => $evaluacion,
                'mensaje' => $message,
                'calificaciones' => $calificaciones,
                'valoresCalificacion' => $valoresCalificacion,
                'css_active' => 'materia',));
    }


    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));

        $evaluacion->setNombre($data->request->get('nombre'));
        $fecha = $data->request->get('fecha');

        $hora = $data->request->get('hora');
        $fecha = Herramientas::fechaHoraADatetime($fecha, $hora);
        $evaluacion->setFecha($fecha);

        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono otra Materia, hay que buscarla y persistirla
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $idMateria));
            $evaluacion->setMateria($materia);
        }

        $periodo = $em->getRepository('BoletinesBundle:Periodo')->find($data->request->get('periodo'));
        if ($periodo) {
            $evaluacion->setPeriodo($periodo);
        }

        $em->persist($evaluacion);
        $em->flush();

        if (!empty($data->files->get('archivos'))) {
            foreach ($data->files->get('archivos') as $archivo) {
                if (!is_null($archivo)) {
                    $archivoService =  $this->get('boletines.servicios.archivo');
                    $archivoService->createEvaluacionArchivo($archivo, $this->getUser(), $evaluacion);
                }
            }
        }

        return $evaluacion;
    }
}
