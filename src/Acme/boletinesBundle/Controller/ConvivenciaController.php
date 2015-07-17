<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\boletinesBundle\Servicios\SesionService;
use Acme\boletinesBundle\Entity\Convivencia;


class ConvivenciaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Convivencia')->findAll();

        return $this->render('BoletinesBundle:Convivencia:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('idConvivencia' => $id));

        return $this->render('BoletinesBundle:Convivencia:show.html.twig', array('convivencia' => $convivencia));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $convivencia = $this->createEntity($request);
            if($convivencia != null) {
                return $this->render('BoletinesBundle:Convivencia:show.html.twig', array('convivencia' => $convivencia));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Alumno')->findAll();
        }

        return $this->render('BoletinesBundle:Convivencia:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $convivencia = new Convivencia();
        $convivencia->setComentarioDocente($data->request->get('comentarioDocente'));
        $convivencia->setDescargoAlumno($data->request->get('descargoAlumno'));
        $convivencia->setDocente($sesionService->obtenerMiEntidadRelacionada());
        $convivencia->setValor($data->request->get('valor'));
        $convivencia->setFechaCarga(new \DateTime('now'));
        //TODO cambiar por parametro
        //$convivencia->setFechaSuceso($data->request->get('fechaSuceso'));
        $convivencia->setFechaSuceso(new \DateTime('now'));

        $idAlumno = $data->request->get('idAlumno');
        if($idAlumno > 0){
            //Selecciono una Alumno
            $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $idAlumno));
            $convivencia->setAlumno($alumno);
        }


        $em->persist($convivencia);
        $em->flush();

        return $convivencia;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('idConvivencia' => $id));

        if($convivencia instanceof Convivencia) {
            $em->remove($convivencia);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $convivencia = $this->editEntity($request, $id);
            if($convivencia != null) {
                return $this->render('BoletinesBundle:Convivencia:show.html.twig', array('convivencia' => $convivencia));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Alumno')->findAll();
            $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('idConvivencia' => $id));
        }

        return $this->render('BoletinesBundle:Convivencia:edit.html.twig', array('convivencia' => $convivencia, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('idConvivencia' => $id));

        $convivencia->setComentarioDocente($data->request->get('comentarioDocente'));
        $convivencia->setDescargoAlumno($data->request->get('descargoAlumno'));
        $convivencia->setDocente($sesionService->obtenerMiEntidadRelacionada());
        $convivencia->setFechaCarga(new \DateTime('now'));
        //TODO cambiar por parametro
        //$convivencia->setFechaSuceso($data->request->get('fechaSuceso'));
        $convivencia->setFechaSuceso(new \DateTime('now'));

        $idAlumno = $data->request->get('idAlumno');
        if($idAlumno > 0){
            //Selecciono una Alumno
            $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $idAlumno));
            $convivencia->setAlumno($alumno);
        }

        $em->persist($convivencia);
        $em->flush();

        return $convivencia;
    }
}

