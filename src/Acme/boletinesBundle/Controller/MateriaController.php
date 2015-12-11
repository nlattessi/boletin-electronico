<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\MateriaDiaHorario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Materia;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\MateriaType;

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

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $this->createEntity($request);
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
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $id));

       if($materia instanceof Materia) {
           $em->remove($materia);
           $em->flush();
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
        $em->flush();

        return $materia;
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $materia = $this->editEntity($request, $id);
            if($materia != null) {
                return $this->render('BoletinesBundle:Materia:show.html.twig', array('materia' => $materia));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:TipoMateria')->findAll();
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $id));
        }

        return $this->render('BoletinesBundle:Materia:edit.html.twig', array('materia' => $materia,
            'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas,
            'css_active' => 'materia',));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $id));

        $materia->setNombreMateria($data->request->get('nombreMateria'));

        $idTipoMateria = $data->request->get('idTipoMateria');
        if($idTipoMateria > 0){
            //Selecciono otro TipoMateria, hay que buscarla y persistirla
            $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $idTipoMateria));
            $materia->setTipoMateria($tipoMateria);
        }

        $em->persist($materia);
        $em->flush();

        return $materia;
    }
}
