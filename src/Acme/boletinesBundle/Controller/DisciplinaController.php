<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\boletinesBundle\Servicios\SesionService;
use Acme\boletinesBundle\Entity\Disciplina;


class DisciplinaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Disciplina')->findAll();

        return $this->render('BoletinesBundle:Disciplina:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));

        return $this->render('BoletinesBundle:Disciplina:show.html.twig', array('disciplina' => $disciplina));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $disciplina = $this->createEntity($request);
            if($disciplina != null) {
                return $this->render('BoletinesBundle:Disciplina:show.html.twig', array('disciplina' => $disciplina));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Alumno')->findAll();
        }

        return $this->render('BoletinesBundle:Disciplina:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $disciplina = new Disciplina();
        $disciplina->setComentarioDocente($data->request->get('comentarioDocente'));
        $disciplina->setDescargoAlumno($data->request->get('descargoAlumno'));
        $disciplina->setDocente($sesionService->obtenerMiEntidadRelacionada());
        $disciplina->setFechaCarga(new \DateTime('now'));
        //TODO cambiar por parametro
        //$disciplina->setFechaSuceso($data->request->get('fechaSuceso'));
        $disciplina->setFechaSuceso(new \DateTime('now'));

        $idAlumno = $data->request->get('idAlumno');
        if($idAlumno > 0){
            //Selecciono una Alumno
            $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $idAlumno));
            $disciplina->setAlumno($alumno);
        }


        $em->persist($disciplina);
        $em->flush();

        return $disciplina;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));

        if($disciplina instanceof Disciplina) {
            $em->remove($disciplina);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $disciplina = $this->editEntity($request, $id);
            if($disciplina != null) {
                return $this->render('BoletinesBundle:Disciplina:show.html.twig', array('disciplina' => $disciplina));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Alumno')->findAll();
            $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));
        }

        return $this->render('BoletinesBundle:Disciplina:edit.html.twig', array('disciplina' => $disciplina, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));

        $disciplina->setComentarioDocente($data->request->get('comentarioDocente'));
        $disciplina->setDescargoAlumno($data->request->get('descargoAlumno'));
        $disciplina->setDocente($sesionService->obtenerMiEntidadRelacionada());
        $disciplina->setFechaCarga(new \DateTime('now'));
        //TODO cambiar por parametro
        //$disciplina->setFechaSuceso($data->request->get('fechaSuceso'));
        $disciplina->setFechaSuceso(new \DateTime('now'));

        $idAlumno = $data->request->get('idAlumno');
        if($idAlumno > 0){
            //Selecciono una Alumno
            $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $idAlumno));
            $disciplina->setAlumno($alumno);
        }

        $em->persist($disciplina);
        $em->flush();

        return $disciplina;
    }
}

