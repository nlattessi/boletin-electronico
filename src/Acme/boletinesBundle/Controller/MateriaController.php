<?php

namespace Acme\boletinesBundle\Controller;

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

        // $entities = $em->getRepository('BoletinesBundle:Materia')->findAll();

        $materias = [];
        $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();

        foreach ($establecimientos as $establecimiento) {
            foreach ($establecimiento->getMaterias() as $materia) {
                $materias[] = $materia;
            }
        }

        // return $this->render('BoletinesBundle:Materia:index.html.twig', array('entities' => $entities));
        return $this->render('BoletinesBundle:Materia:index2.html.twig', array(
            'institucion' => $this->getUser()->getInstitucion(),
            'materias' => $materias
        ));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));

        $evaluaciones = $em->getRepository('BoletinesBundle:Evaluacion')->findBy(array('materia' => $materia));

        return $this->render('BoletinesBundle:Materia:home.html.twig', array(
            'institucion' => $this->getUser()->getInstitucion(),
            'materia' => $materia,
            'evaluaciones' => $evaluaciones
        ));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $materia = $this->createEntity($request);
            if($materia != null) {
                // return $this->render('BoletinesBundle:Materia:show.html.twig', array('materia' => $materia));
                return new RedirectResponse($this->generateUrl('materia', array()));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            // $entitiesRelacionadas = $em->getRepository('BoletinesBundle:TipoMateria')->findAll();
            $tiposMateria = [];
            $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();

            foreach ($establecimientos as $establecimiento) {
                foreach ($establecimiento->getTiposMateria() as $tipoMateria) {
                    $tiposMateria[] = $tipoMateria;
                }
            }
        }

        // return $this->render('BoletinesBundle:Materia:new.html.twig', array('mensaje' => $message, 'entitiesRelacionadas' => $entitiesRelacionadas));
        return $this->render('BoletinesBundle:Materia:new2.html.twig', array(
            'mensaje' => $message,
            'tiposMateria' => $tiposMateria,
            'establecimientos' => $establecimientos
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('id' => $id));

        if($materia instanceof Materia) {
            $em->remove($materia);
            $em->flush();
        }

        return new RedirectResponse($this->generateUrl('materia', array()));
    }

    private function createEntity($data)
    {
    	$em = $this->getDoctrine()->getManager();

    //     $sesionService = $this->get('boletines.servicios.sesion');
    //     $actividadService =  $this->get('boletines.servicios.actividad');
    //     $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
    //
    // 	$tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $data->request->get('idTipoMateria')));
    //     $usuario =  $sesionService->obtenerUsuario();
		// $calendario = new Calendario();
		// $calendario ->setUsuarioPropietario($usuario);
		// $calendario ->setNombreCalendario("Calendario de " . $data->request->get('nombreMateria'));
		// $em->persist($calendario);
    //     $em->flush();
    //
    //     $actividad = $actividadService->crearActividad('borrar despues',
    //         'harcodeamela toda'
    //         ,new \DateTime('now')
    //         ,new \DateTime('now'),
    //        $usuario,
    //         null);
    //     $muchosAMuchos->asociarCalendarioActividad($calendario,$actividad);
    //     $materia = new Materia();
    //     $materia->setNombreMateria($data->request->get('nombreMateria'));
    // //    $materia->setIdTipoMateria($data->request->get('idTipoMateria'));
    //     $materia->setTipoMateria($tipoMateria);
    //     $materia->setCalendarioMateria($calendario);


        $materia = new Materia();
        $materia->setNombre($data->request->get('nombre'));
        $materia->setDescripcion($data->request->get('descripcion'));

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $materia->setEstablecimiento($establecimiento);

        if ($data->request->get('tipoMateria')) {
            $tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('id' => $data->request->get('tipoMateria')));
            $materia->setTipoMateria($tipoMateria);
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

        return $this->render('BoletinesBundle:Materia:edit.html.twig', array('materia' => $materia, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
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
