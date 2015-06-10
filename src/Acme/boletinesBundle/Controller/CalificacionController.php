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

        $entities = $em->getRepository('BoletinesBundle:Calificacion')->findAll();

        return $this->render('BoletinesBundle:Calificacion:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        return $this->render('BoletinesBundle:Calificacion:show.html.twig', array('calificacion' => $calificacion));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $calificacion = $this->createEntity($request);
            if($calificacion != null) {
                return $this->render('BoletinesBundle:Calificacion:show.html.twig', array('calificacion' => $calificacion));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Examen')->findAll();
            $alumnosDelExamen = $em->getRepository('BoletinesBundle:Alumno')->findAll();
        }

        return $this->render('BoletinesBundle:Calificacion:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas, 'alumnosDelExamen' => $alumnosDelExamen));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $calificacion = new Calificacion();
        $calificacion->setValorCalificacion($data->request->get('valorCalificacion'));
        $calificacion->setComentarioCalificacion($data->request->get('comentarioCalificacion'));
        $calificacion->setFechaCalificacion(new \DateTime('now'));
        $calificacion->setValidada('N');
        $idExamen = $data->request->get('idExamen');
        if($idExamen > 0){
            //Selecciono una Examen
            $examen = $em->getRepository('BoletinesBundle:Examen')->findOneBy(array('idExamen' => $idExamen));
            $calificacion->setExamen($examen);
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
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Examen')->findAll();
            $alumnosDelExamen = $em->getRepository('BoletinesBundle:Alumno')->findAll();
            $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));
        }

        return $this->render('BoletinesBundle:Calificacion:edit.html.twig', array('calificacion' => $calificacion, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas, 'alumnosDelExamen' => $alumnosDelExamen));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $calificacion = $em->getRepository('BoletinesBundle:Calificacion')->findOneBy(array('idCalificacion' => $id));

        $calificacion->setValorCalificacion($data->request->get('valorCalificacion'));
        $calificacion->setComentarioCalificacion($data->request->get('comentarioCalificacion'));
        $calificacion->setFechaCalificacion(new \DateTime('now'));

        $idExamen = $data->request->get('idExamen');
        if($idExamen > 0){
            //Selecciono otra Examen, hay que buscarla y persistirla
            $examen = $em->getRepository('BoletinesBundle:Examen')->findOneBy(array('idExamen' => $idExamen));
            $calificacion->setExamen($examen);
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

