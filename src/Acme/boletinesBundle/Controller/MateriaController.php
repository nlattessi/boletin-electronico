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



        return $this->render('BoletinesBundle:Materia:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $id));

        return $this->render('BoletinesBundle:Materia:show.html.twig', array('materia' => $materia));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $materia = $this->createEntity($request);
            if($materia != null) {
                return $this->render('BoletinesBundle:Materia:show.html.twig', array('materia' => $materia));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:TipoMateria')->findAll();
        }

        return $this->render('BoletinesBundle:Materia:new.html.twig', array('mensaje' => $message, 'entitiesRelacionadas' => $entitiesRelacionadas));
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

        $sesionService = $this->get('boletines.servicios.sesion');
        $actividadService =  $this->get('boletines.servicios.actividad');
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
			
    	$tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $data->request->get('idTipoMateria')));
        $usuario =  $sesionService->obtenerUsuario();
		$calendario = new Calendario();
		$calendario ->setUsuarioPropietario($usuario);
		$calendario ->setNombreCalendario("Calendario de " . $data->request->get('nombreMateria'));
		$em->persist($calendario);
        $em->flush();

        $actividad = $actividadService->crearActividad('borrar despues',
            'harcodeamela toda'
            ,new \DateTime('now')
            ,new \DateTime('now'),
           $usuario,
            null);
        $muchosAMuchos->asociarCalendarioActividad($calendario,$actividad);
        $materia = new Materia();
        $materia->setNombreMateria($data->request->get('nombreMateria'));
    //    $materia->setIdTipoMateria($data->request->get('idTipoMateria'));
        $materia->setTipoMateria($tipoMateria);
        $materia->setCalendarioMateria($calendario);

   
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
