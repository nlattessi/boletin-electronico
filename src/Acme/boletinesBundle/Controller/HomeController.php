<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\UsuarioType;

class HomeController extends Controller
{

    public function defaultAction(){
        $request = $this->getRequest();
        $session = $request->getSession();


        if ($this->getUser()->getRol()->getNombre() == 'ROLE_PADRE' ||
            $this->getUser()->getRol()->getNombre() == 'ROLE_ALUMNO' ) {
            $asistenciaService =  $this->get('boletines.servicios.asistencia');
            $calificacionesService =  $this->get('boletines.servicios.calificacion');
            $convivenciaService =  $this->get('boletines.servicios.convivencia');

            $alumno = $session->get('alumnoActivo');
            $establecimiento = $session->get('establecimientoActivo');
            //Asistencia
            $tardes = $asistenciaService->obtenerTardesPorAlumno($alumno->getId());
            $faltas = $asistenciaService->obtenerFaltasTotales($alumno->getId(),$establecimiento->getTardesFaltas());
            //Calificaciones
            $ultimasCalificaciones = $calificacionesService->obtenerUltimasCalificaciones($alumno->getId());

            //Convivencia
            $convivenciaPositiva = $convivenciaService->obtenerConvivenciaPositivaAlumno($alumno->getId());
            $convivenciaNegativa = $convivenciaService->obtenerConvivenciaNegativaAlumno($alumno->getId());

            return $this->render('BoletinesBundle:Default:home.html.twig', array('tardes' => count($tardes),
                'faltas' => $faltas,
                'calificaciones' => $ultimasCalificaciones,
                'conPos' => count($convivenciaPositiva),
                'conNeg' => count($convivenciaNegativa),
                'css_active' => 'home',));

        }
        else if ($this->getUser()->getRol()->getNombre() == 'ROLE_DOCENTE'){
            $docente = $session->get('docenteActivo');
            $materiaService =  $this->get('boletines.servicios.materia');
            $evaluacionService =  $this->get('boletines.servicios.evaluacion');

            $materias = $materiaService->listaMateriasPorDocente($docente->getId());
            $evaluaciones = $evaluacionService->proximasNEvaluacionesPorDocente($docente->getId(),null);

            return $this->render('BoletinesBundle:Default:home.html.twig', array('materias' => $materias,
                'evaluaciones' => $evaluaciones,
                'css_active' => 'home',
                ));
        }else if ($this->getUser()->getRol()->getNombre() == 'ROLE_ADMIN'){
            $em = $this->getDoctrine()->getManager();

            $alumnos = $em->getRepository('BoletinesBundle:Alumno')->findAll();
            $instituciones=$em->getRepository('BoletinesBundle:Institucion')->findAll();

            return $this->render('BoletinesBundle:Default:home.html.twig', array('instituciones' => $instituciones,
                'alumnos' => $alumnos,
                'css_active' => 'home',
            ));
        }else if($this->getUser()->getRol()->getNombre() == 'ROLE_DIRECTIVO'){
            $user = $this->getUser();
            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
            $cantidadAlumnos = count($muchosAMuchos->obtenerAlumnosPorEstablecimientos($establecimientos));
            $cantidadPadres = count($muchosAMuchos->obtenerPadresPorEstablecimientos($establecimientos));
            $cantidadDocentes = count($muchosAMuchos->obtenerDocentesPorEstablecimientos($establecimientos));
            $cantidadBedeles = count($muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_BEDEL'));
            $cantidadDirectivos = count($muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_DIRECTIVO'));
            $cantidadAdmins = count($muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_ADMIN'));

            $roles = array(
                'alumnos' => $cantidadAlumnos,
                'padres' => $cantidadPadres,
                'docentes' => $cantidadDocentes,
                'bedeles' => $cantidadBedeles,
                'directivos' => $cantidadDirectivos,
                'admins' => $cantidadAdmins
            );
            return $this->render('BoletinesBundle:Default:home.html.twig', array('roles' => $roles));
        }

        return $this->render('BoletinesBundle:Default:home.html.twig');
    }

    public function fatherAction()
    {
        return $this->render('BoletinesBundle:Home:father.html.twig', array());
    }

    public function fatherAsistenciaAction()
    {
        return $this->render('BoletinesBundle:Home:father.asistencia.html.twig', array());
    }

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $instituciones = $em->getRepository('BoletinesBundle:Institucion')->findAll();
        $institucionesCount = count($instituciones);

        $alumnos = $em->getRepository('BoletinesBundle:Alumno')->findAll();
        $alumnosCount = count($alumnos);

        $alumnosCount = 7650; //HARDCODEADO PARA DEMO2

        return $this->render('BoletinesBundle:Home:admin.html.twig', array('institucionesCount' => $institucionesCount,
            'alumnosCount' => $alumnosCount,
            'css_active' => 'home',));
    }

    public function inst_manuel_belgranoAction()
    {
        return $this->render('BoletinesBundle:Home:inst_manuel_belgrano.html.twig', array());
    }

    public function inst_belgrano_day_schoolAction()
    {
        return $this->render('BoletinesBundle:Home:inst_belgrano_day_school.html.twig', array());
    }

    public function under_constructionAction()
    {
        return $this->render('BoletinesBundle:Home:under_construction.html.twig', array());
    }

    public function alumnoAction()
    {
        return $this->render('BoletinesBundle:Home:alumno.html.twig', array());
    }

    public function alumnoAsistenciaAction()
    {
        return $this->render('BoletinesBundle:Home:alumno.asistencia.html.twig', array());
    }

    public function directivoAlumnosAction()
    {
        return $this->render('BoletinesBundle:Home:directivo.alumnos.html.twig', array());
    }

    public function directivoAlumnoDatosAction()
    {
        return $this->render('BoletinesBundle:Home:directivo.alumno.datos.html.twig', array());
    }

    public function directivoAlumnoEditarAction()
    {
        return $this->render('BoletinesBundle:Home:directivo.alumno.editar.html.twig', array());
    }
}
