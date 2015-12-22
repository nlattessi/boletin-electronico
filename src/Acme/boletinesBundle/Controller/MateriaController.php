<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Docente;
use Acme\boletinesBundle\Entity\DocenteMateria;
use Acme\boletinesBundle\Entity\Evaluacion;
use Acme\boletinesBundle\Entity\GrupoAlumnoMateria;
use Acme\boletinesBundle\Entity\MateriaDiaHorario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Materia;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\MateriaType;
use Symfony\Component\HttpFoundation\RedirectResponse;


class MateriaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()->getRol()->getNombre() == 'ROLE_DOCENTE')
        {
            $materiaService =  $this->get('boletines.servicios.materia');
            $request = $this->getRequest();
            $session = $request->getSession();
            $docente = $session->get('docenteActivo');
            $entities = $materiaService->listaMateriasPorDocente($docente->getId());
        }elseif($this->getUser()->getRol()->getNombre() == 'ROLE_DIRECTIVO'){
            $user = $this->getUser();
            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
            $entities = $muchosAMuchos->obtenerMateriasPorEstablecimientos($establecimientos);
        }
        else{
            $entities = $em->getRepository('BoletinesBundle:Materia')->findAll();
        }



        return $this->render('BoletinesBundle:Materia:index.html.twig', array('entities' => $entities,
            'css_active' => 'materia',));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));

        if($materia){
            $materiaService =  $this->get('boletines.servicios.materia');
           $materia = $materiaService->materiaLoad($materia);
        }


        return $this->render('BoletinesBundle:Materia:home.html.twig', array('materia' => $materia,
            'css_active' => 'materia',));
    }

    public function bajaEvaluacionAction($id){
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('id' => $id));
        $materia = $evaluacion->getMateria()->getId();
        if($evaluacion instanceof Evaluacion) {
            $bajaAdministrativaService = $this->get('boletines.servicios.bajaAdministrativa');
            $bajaAdministrativaService->darDeBaja($evaluacion);
            // $em->remove($evaluacion);
            // $em->flush();
        }
        return $this->getOneAction($materia);
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $materia = $this->createEntity($request);
            if($materia instanceof Materia) {
                $this->get('session')->getFlashBag()->add('success', 'Nueva materia creada con éxito');
            }
        }

        $docentes = $this->getDocentes();
        $tipoMateria = $this->getTipoMateria();
        $grupoAlumnos = $this->getGrupoAlumnos();
        $establecimientos = $this->getEstablecimientos();

        return $this->render('BoletinesBundle:Materia:new.html.twig', array('docentes' => $docentes,
            'gruposAlumnos' => $grupoAlumnos, 'tiposMateria' => $tipoMateria, 'establecimientos' => $establecimientos));
    }

    private function getDocentes()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        return $muchosAMuchos->obtenerDocentesPorEstablecimientos($establecimientos);

    }

    private function getTipoMateria()
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('BoletinesBundle:TipoMateria')->findAll();
    }

    private function getGrupoAlumnos()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        return $muchosAMuchos->obtenerGruposAlumnosPorEstablecimientos($establecimientos);
    }

    private function getEstablecimientos()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');

        return $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));

       if($materia instanceof Materia) {
           $bajaAdministrativaService = $this->get('boletines.servicios.bajaAdministrativa');
           $bajaAdministrativaService->darDeBaja($materia);
       }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
    	$em = $this->getDoctrine()->getManager();

    	$tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('id' => $data->request->get('tipo_materia')));
    	$establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $materia = new Materia();
        $materia->setEstablecimiento($establecimiento);
        $materia->setNombre($data->request->get('nombre'));
        $materia->setTipoMateria($tipoMateria);

        if($data->request->get('lunes_chk') == 'on')
        {
            $horario = new MateriaDiaHorario();
            $horario->setDia('Lunes');
            $horario->setHoraInicio($data->request->get('lunes_inicio'));
            $horario->setHoraFin($data->request->get('lunes_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        }
        if($data->request->get('martes_chk') == 'on')
        {
            $horario = new MateriaDiaHorario();
            $horario->setDia('Martes');
            $horario->setHoraInicio($data->request->get('martes_inicio'));
            $horario->setHoraFin($data->request->get('martes_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        }
        if($data->request->get('miercoles_chk') == 'on')
        {
            $horario = new MateriaDiaHorario();
            $horario->setDia('Miercoles');
            $horario->setHoraInicio($data->request->get('miercoles_inicio'));
            $horario->setHoraFin($data->request->get('miercoles_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        }
        if($data->request->get('jueves_chk') == 'on')
        {
            $horario = new MateriaDiaHorario();
            $horario->setDia('Jueves');
            $horario->setHoraInicio($data->request->get('jueves_inicio'));
            $horario->setHoraFin($data->request->get('jueves_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        }
        if($data->request->get('viernes_chk') == 'on')
        {
            $horario = new MateriaDiaHorario();
            $horario->setDia('Viernes');
            $horario->setHoraInicio($data->request->get('viernes_inicio'));
            $horario->setHoraFin($data->request->get('viernes_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        }
        if($data->request->get('sabado_chk') == 'on')
        {
            $horario = new MateriaDiaHorario();
            $horario->setDia('Sabado');
            $horario->setHoraInicio($data->request->get('sabado_inicio'));
            $horario->setHoraFin($data->request->get('sabado_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        }
        $em->persist($materia);

        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('id' => $data->request->get('docente')));
        if($docente) {
            $docenteMateria = new DocenteMateria();
            $docenteMateria->setDocente($docente);
            $docenteMateria->setMateria($materia);
            $em->persist($docenteMateria);
        }
        $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('id' => $data->request->get('docente')));
        if($grupoAlumno) {
            $grupoMateria = new GrupoAlumnoMateria();
            $grupoMateria->setMateria($materia);
            $grupoMateria->setGrupoAlumno($grupoAlumno);
            $em->persist($grupoMateria);
        }

        $em->flush();

        return $materia;
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('id' => $data->request->get('tipo_materia')));
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));
        $materia->setEstablecimiento($establecimiento);
        $materia->setNombre($data->request->get('nombre'));
        $materia->setTipoMateria($tipoMateria);

        if($data->request->get('lunes_chk') == 'on')
        {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Lunes'));
            if ($exists instanceof MateriaDiaHorario) {
                $horario = $exists;
            } else {
                $horario = new MateriaDiaHorario();

            }
            $horario->setDia('Lunes');
            $horario->setHoraInicio($data->request->get('lunes_inicio'));
            $horario->setHoraFin($data->request->get('lunes_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        } else {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Lunes'));
            if($exists instanceof MateriaDiaHorario) {
                $em->remove($exists);
                $em->flush();
            }
        }
        if($data->request->get('martes_chk') == 'on')
        {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Martes'));
            if ($exists instanceof MateriaDiaHorario) {
                $horario = $exists;
            } else {
                $horario = new MateriaDiaHorario();

            }

            $horario->setDia('Martes');
            $horario->setHoraInicio($data->request->get('martes_inicio'));
            $horario->setHoraFin($data->request->get('martes_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        } else {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Martes'));
            if($exists instanceof MateriaDiaHorario) {
                $em->remove($exists);
                $em->flush();
            }
        }
        if($data->request->get('miercoles_chk') == 'on')
        {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Miercoles'));
            if ($exists instanceof MateriaDiaHorario) {
                $horario = $exists;
            } else {
                $horario = new MateriaDiaHorario();

            }
            $horario->setDia('Miercoles');
            $horario->setHoraInicio($data->request->get('miercoles_inicio'));
            $horario->setHoraFin($data->request->get('miercoles_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        } else {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Miercoles'));
            if($exists instanceof MateriaDiaHorario) {
                $em->remove($exists);
                $em->flush();
            }
        }
        if($data->request->get('jueves_chk') == 'on')
        {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Jueves'));
            if ($exists instanceof MateriaDiaHorario) {
                $horario = $exists;
            } else {
                $horario = new MateriaDiaHorario();

            }
            $horario->setDia('Jueves');
            $horario->setHoraInicio($data->request->get('jueves_inicio'));
            $horario->setHoraFin($data->request->get('jueves_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        } else {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Jueves'));
            if($exists instanceof MateriaDiaHorario) {
                $em->remove($exists);
                $em->flush();
            }
        }
        if($data->request->get('viernes_chk') == 'on')
        {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Viernes'));
            if ($exists instanceof MateriaDiaHorario) {
                $horario = $exists;
            } else {
                $horario = new MateriaDiaHorario();

            }
            $horario->setDia('Viernes');
            $horario->setHoraInicio($data->request->get('viernes_inicio'));
            $horario->setHoraFin($data->request->get('viernes_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        } else {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Viernes'));
            if($exists instanceof MateriaDiaHorario) {
                $em->remove($exists);
                $em->flush();
            }
        }
        if($data->request->get('sabado_chk') == 'on')
        {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Sabado'));
            if ($exists instanceof MateriaDiaHorario) {
                $horario = $exists;
            } else {
                $horario = new MateriaDiaHorario();

            }
            $horario->setDia('Sabado');
            $horario->setHoraInicio($data->request->get('sabado_inicio'));
            $horario->setHoraFin($data->request->get('sabado_fin'));
            $em->persist($horario);

            $materia->addHorarios($horario);
        } else {
            $exists = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findOneBy(array('materia' => $materia, 'dia' => 'Sabado'));
            if($exists instanceof MateriaDiaHorario) {
                $em->remove($exists);
                $em->flush();
            }
        }
        $em->persist($materia);

        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('id' => $data->request->get('docente')));
        $docenteMateria  = $em->getRepository('BoletinesBundle:DocenteMateria')->findOneBy(array('materia' => $materia));
        if($docenteMateria){
            $docenteMateria->setDocente($docente);
        }else{
            $docenteMateria = new DocenteMateria();
            $docenteMateria->setDocente($docente);
            $docenteMateria->setMateria($materia);
        }
        $em->persist($docenteMateria);

        $gurpoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('id' => $data->request->get('grupoAlumno')));
        //si se ingresó un grupo de alumno
        if($gurpoAlumno) {
            $gruopoMateria = $em->getRepository('BoletinesBundle:GrupoAlumnoMateria')->findOneBy(array('materia' => $materia, 'grupoAlumno' => $gurpoAlumno));
            if (!$gruopoMateria) {
                //si no encontré la asociación
                $gruopoMateria = new GrupoAlumnoMateria();
                $gruopoMateria->setMateria($materia);
                $gruopoMateria->setGrupoAlumno($gurpoAlumno);
            }
            $em->persist($gruopoMateria);
        }
        $em->flush();

        return $materia;
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $materia = $this->editEntity($request, $id);
            if($materia != null) {
                return new RedirectResponse($this->generateUrl('materia'));
            }
        }
        $em = $this->getDoctrine()->getManager();
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));
        $docentes = $this->getDocentes();
        $tipoMateria = $this->getTipoMateria();
        $grupoAlumnos = $this->getGrupoAlumnos();
        $establecimientos = $this->getEstablecimientos();
        $materiaDiaHorario = $em->getRepository('BoletinesBundle:MateriaDiaHorario')->findBy(array('materia' => $materia));

        $dias = array();
        foreach($materiaDiaHorario as $materiaDia) {
         $dias[$materiaDia->getDia()]['horaFin'] = $materiaDia->getHoraFin();
         $dias[$materiaDia->getDia()]['horaInicio'] = $materiaDia->getHoraInicio();
        }

        $docenteSeleccionado = $em->getRepository('BoletinesBundle:DocenteMateria')->findOneBy(array('materia' => $materia));
        $docenteSeleccionadoId = null;
        if($docenteSeleccionado instanceof DocenteMateria) {
            $docenteSeleccionadoId = $docenteSeleccionado->getDocente()->getId();
        }

        $grupoAlumnoMateria = $em->getRepository('BoletinesBundle:GrupoAlumnoMateria')->findOneBy(array('materia' => $materia));
        $grupoAlumnoMateriaId = null;
        if($grupoAlumnoMateria instanceof GrupoAlumnoMateria) {
            $grupoAlumnoMateriaId = $grupoAlumnoMateria->getGrupoAlumno()->getId();
        }
        return $this->render('BoletinesBundle:Materia:edit.html.twig', array('materia' => $materia, 'docentes' => $docentes,
            'gruposAlumnos' => $grupoAlumnos, 'tiposMateria' => $tipoMateria,
            'establecimientos' => $establecimientos,
            'dias' => $dias, 'docenteSeleccionadoId' => $docenteSeleccionadoId,
            'grupoAlumnoMateriaId' => $grupoAlumnoMateriaId));
    }

    public function uploadAction($id, Request $request)
    {
        if ($request->getMethod() == 'POST') {
            if (!empty ($request->files->get('archivo'))) {
                $em = $this->getDoctrine()->getManager();
                $archivoService = $this->get('boletines.servicios.archivo');
                $archivoService->createMateriaArchivo(
                    $request->files->get('archivo'),
                    $this->getUser(),
                    $em->getRepository('BoletinesBundle:Materia')->find($id)
                );
            }
        }

        return $this->redirect($this->generateUrl('materia_show', ['id' => $id]), 301);
    }
}
