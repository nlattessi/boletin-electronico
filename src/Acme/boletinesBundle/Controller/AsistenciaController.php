<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\AlumnoAsistencia;
use Acme\boletinesBundle\Utils\Herramientas;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Asistencia;
use Acme\boletinesBundle\Entity\Calendario;

use Acme\boletinesBundle\Utils\WrapperAlumnoAsistencia;

class AsistenciaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tardes = [];
        $ausentes = [];

        if($this->getUser()->getRol()->getNombre() == 'ROLE_PADRE' ||
            $this->getUser()->getRol()->getNombre() == 'ROLE_ALUMNO'){
            $request = $this->getRequest();
            $session = $request->getSession();
            $alumno = $session->get('alumnoActivo');
            $establecimiento = $session->get('establecimientoActivo');

            if($alumno){
                $asistenciaService =  $this->get('boletines.servicios.asistencia');
                $entities = $asistenciaService->obtenerAsistenciaAlumno($alumno->getId());
                $tardes = $asistenciaService->obtenerTardesPorAlumno($alumno->getId());
                $faltas = $asistenciaService->obtenerFaltasTotales($alumno->getId(),$establecimiento->getTardesFaltas());
                return $this->render('BoletinesBundle:Asistencia:index.html.twig', array('entities' => $entities,
                    'tardes' => count($tardes),
                    'faltas' => $faltas));
            }else{
                return $this->render('BoletinesBundle:Asistencia:index.html.twig', array('entities' => null, 'mensaje' => "Usted no tiene hijos asociados, consulte con el administrador"));
            }
        }else if($this->getUser()->getRol()->getNombre() == 'ROLE_DOCENTE'){
            $materiaService =  $this->get('boletines.servicios.materia');
            $request = $this->getRequest();
            $session = $request->getSession();
            $docente = $session->get('docenteActivo');
            $entities = $materiaService->listaMateriasPorDocente($docente->getId());
            $ahora = new \DateTime('now');
            return $this->render('BoletinesBundle:Asistencia:elegir.html.twig', array('entities' => $entities,
                'hoy' =>$ahora ,));
        }else if($this->getUser()->getRol()->getNombre() == 'ROLE_BEDEL'){
            $entities = $em->getRepository('BoletinesBundle:Materia')->findAll();
            $ahora = new \DateTime('now');
            return $this->render('BoletinesBundle:Asistencia:elegir.html.twig', array('entities' => $entities,
                'hoy' =>$ahora ,));
        }

        else{
            $entities = $em->getRepository('BoletinesBundle:Asistencia')->findAll();
        }

        return $this->render('BoletinesBundle:Asistencia:index.html.twig', array('entities' => $entities,));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $asistencia = $em->getRepository('BoletinesBundle:Asistencia')->findOneBy(array('idAsistencia' => $id));

        return $this->render('BoletinesBundle:Asistencia:show.html.twig', array('asistencia' => $asistencia));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $asistencia = $this->createEntity($request);
            if($asistencia != null) {
                return $this->render('BoletinesBundle:Asistencia:show.html.twig', array('asistencia' => $asistencia));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Materia')->findAll();
        }

        return $this->render('BoletinesBundle:Asistencia:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $asistencia = new Asistencia();
        //$asistencia->setFechaAsistencia($data->request->get('fechaAsistencia'));
        $asistencia->setFechaAsistencia(new \DateTime('now'));
        $asistencia->setFechaCarga(new \DateTime('now'));
        $asistencia->setUsuarioCargador($sesionService->obtenerUsuario());

        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono una Materia
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $idMateria));
            $asistencia->setMateria($materia);
        }

        $em->persist($asistencia);
        $em->flush();

        return $asistencia;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $asistencia = $em->getRepository('BoletinesBundle:Asistencia')->findOneBy(array('idAsistencia' => $id));

        if($asistencia instanceof Asistencia) {
            $em->remove($asistencia);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $em = $this->getDoctrine()->getManager();
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));
        $asistenciaService =  $this->get('boletines.servicios.asistencia');

        if ($request->getMethod() == 'POST') {
            $fecha = $request->request->get('fecha');
            $fecha = Herramientas::textoADatetime($fecha);
            $alumnoAsistencia = $asistenciaService->obtenerAlumnoAsistenciaDelDia($fecha->format('Y-m-d'), $id);
            foreach($alumnoAsistencia as $alas){
                $valorModificado = $request->request->get($alas->getId());
                if($valorModificado){
                    $alas->setValor($valorModificado);
                }
            }
            $em->flush();
        } else {
            $fecha = $_GET['fecha'];
            $fecha = Herramientas::textoADatetime($fecha);
            $alumnoAsistencia = $asistenciaService->obtenerAlumnoAsistenciaDelDia($fecha->format('Y-m-d'), $id);
            if(!$alumnoAsistencia){
                $materiaService =  $this->get('boletines.servicios.materia');
                $alumnos = $materiaService->listaAlumnos($id);
                return  $this->render('BoletinesBundle:Asistencia:tomar.html.twig',
                    array('alumnos' => $alumnos, 'fecha' =>$fecha , 'materia' => $materia));
            }
        }

        return $this->render('BoletinesBundle:Asistencia:edit.html.twig', array('asistencias' => $alumnoAsistencia,
            'fecha' => $fecha,
            'materia' => $materia,));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');
        $asistencia = $em->getRepository('BoletinesBundle:Asistencia')->findOneBy(array('idAsistencia' => $id));

        //$asistencia->setFechaAsistencia($data->request->get('fechaAsistencia'));
        $asistencia->setFechaAsistencia(new \DateTime('now'));
        $asistencia->setFechaCarga(new \DateTime('now'));
        $asistencia->setUsuarioCargador($sesionService->obtenerUsuario());

        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono otra Materia, hay que buscarla y persistirla
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $idMateria));
            $asistencia->setMateria($materia);

        }

        $em->persist($asistencia);
        $em->flush();

        return $asistencia;
    }


    public function tomarAsistenciaAction($id = null, Request $request = null){
        //el id es el de la materia
        $em = $this->getDoctrine()->getManager();
        $materiaService =  $this->get('boletines.servicios.materia');
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));
        $alumnos = $materiaService->listaAlumnos($id);
        $ahora = new \DateTime('now');
        if ($request->getMethod() == 'POST') {
            $asistencia = new Asistencia();
            $asistencia->setFechaCarga($ahora);
            $asistencia->setFechaActualizacion($ahora);
            $fecha = $request->request->get('fecha');
            $fecha = Herramientas::textoADatetime($fecha);
            $asistencia->setFecha($fecha);
            $asistencia->setMateria($materia);
            $asistencia->setUsuarioCargador($this->getUser());
            $em->persist($asistencia);
            foreach($alumnos as $alumno){
                $alAsis = new AlumnoAsistencia();
                $alAsis->setAlumno($alumno);
                $alAsis->setAsistencia($asistencia);
                $alAsis->setValor($request->get($alumno->getId()));
                $alAsis->setCreationTime($ahora);
                $em->persist($alAsis);
            }
            $em->flush();
            return $this->verUltimasAction($id, $request);
        }

        return  $this->render('BoletinesBundle:Asistencia:tomar.html.twig',
            array('alumnos' => $alumnos, 'fecha' =>$ahora , 'materia' => $materia));
    }

    public function verUltimasAction($id = null, Request $request = null){
        $em = $this->getDoctrine()->getManager();
        $asistenciaService =  $this->get('boletines.servicios.asistencia');
        $materiaService =  $this->get('boletines.servicios.materia');
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));
        $asistencias = $asistenciaService->obtenerUltimasMateria($id);
        $alumnos = $materiaService->listaAlumnos($id);
        $asistenciasMostrables = array();
        foreach($alumnos as $alumno){
            $asistenciasAlumno = $asistenciaService->obtenerAsistenciaAlumnoLimite($alumno->getId(), 7);
            $wrapperAlumnoAsistencia = new WrapperAlumnoAsistencia();
            $wrapperAlumnoAsistencia->setAlumno($alumno);
            $wrapperAlumnoAsistencia->setAsistencias($asistenciasAlumno);
            array_push($asistenciasMostrables,$wrapperAlumnoAsistencia );
        }

        return $this->render('BoletinesBundle:Asistencia:show.html.twig',
            array('asistencias' => $asistencias, 'asistenciasMostrables' =>$asistenciasMostrables , 'materia' => $materia));
    }
}

