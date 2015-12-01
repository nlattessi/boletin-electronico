<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Servicios\ActividadService;
use Acme\boletinesBundle\Servicios\SesionService;
use Proxies\__CG__\Acme\boletinesBundle\Entity\Evaluacion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Examen;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\ExamenType;

class ExamenController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Evaluacion')->findAll();

        return $this->render('BoletinesBundle:Examen:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $examen = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('idExamen' => $id));

        return $this->render('BoletinesBundle:Examen:show.html.twig', array('examen' => $examen));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $examen = $this->createEntity($request);
            if($examen != null) {
                return $this->render('BoletinesBundle:Examen:show.html.twig', array('examen' => $examen));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Materia')->findAll();
        }

        return $this->render('BoletinesBundle:Examen:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');
        $actividadService =  $this->get('boletines.servicios.actividad');

        $examen = new Evaluacion();
        $examen->setNombre($data->request->get('nombreExamen'));
        // $fechaExamen = $data->request->get('fechaExamen');
        //hasta que no tengamos el controller de fechas no vale la pena formatear el string
        $examen->setFecha(new \DateTime('now'));
        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono una Materia
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $idMateria));
            $examen->setMateria($materia);
        }else{
            //error, no puede no tener materia
        }

        $usuario = $sesionService->obtenerUsuario();

        $examen->setDocente($sesionService->obtenerMiEntidadRelacionada());
        $examen->setActividad($actividadService->crearActividad($examen->getNombre(),
            "Actividad automatica del examen", $examen->getFecha(),$examen->getFecha(),
            $usuario, null));

        $em->persist($examen);
        $em->flush();

        return $examen;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $examen = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('idExamen' => $id));

        if($examen instanceof Evaluacion) {
            $em->remove($examen);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $examen = $this->editEntity($request, $id);
            if($examen != null) {
                return $this->render('BoletinesBundle:Examen:show.html.twig', array('examen' => $examen));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Materia')->findAll();
            $examen = $em->getRepository('BoletinesBundle:Evaluacion')->findOneBy(array('idExamen' => $id));
        }

        return $this->render('BoletinesBundle:Examen:edit.html.twig', array('examen' => $examen, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $examen = $em->getRepository('BoletinesBundle:Examen')->findOneBy(array('idExamen' => $id));

        $examen->setNombreExamen($data->request->get('nombreExamen'));
       // $fechaExamen = $data->request->get('fechaExamen');
        //hasta que no tengamos el controller de fechas no vale la pena formatear el string
        $examen->setFechaExamen(new \DateTime('now'));

        $idMateria = $data->request->get('idMateria');
        if($idMateria > 0){
            //Selecciono otra Materia, hay que buscarla y persistirla
            $materia = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $idMateria));
            $examen->setMateria($materia);
        }

        $em->persist($examen);
        $em->flush();

        return $examen;
    }
}

