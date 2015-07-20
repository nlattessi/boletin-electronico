<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Alumno;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\AlumnoType;

class AlumnoController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Alumno')->findAll();

        return $this->render('BoletinesBundle:Alumno:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $id));

        return $this->render('BoletinesBundle:Alumno:show.html.twig', array('alumno' => $alumno));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $alumno = $this->createEntity($request);
            if($alumno != null) {
                return $this->render('BoletinesBundle:Alumno:show.html.twig', array('alumno' => $alumno));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $padres = $em->getRepository('BoletinesBundle:Usuario')->findAll();
        }

        return $this->render('BoletinesBundle:Alumno:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas, 'padres'=> $padres));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $alumno = new Alumno();
        $alumno->setNombreAlumno($data->request->get('nombreAlumno'));
        $idUsuarioAlumno = $data->request->get('idUsuarioAlumno');
        if($idUsuarioAlumno > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioAlumno));
            $alumno->setUsuarioAlumno($entityRelacionada);
        }
        $idUsuarioPadre1 = $data->request->get('idUsuarioPadre1');
        if($idUsuarioPadre1 > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre1));
            $alumno->setUsuarioPadre1($entityRelacionada);
        }
        $idUsuarioPadre2 = $data->request->get('idUsuarioPadre2');
        if($idUsuarioPadre2 > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre2));
            $alumno->setUsuarioPadre2($entityRelacionada);
        }


        $em->persist($alumno);
        $em->flush();

        return $alumno;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $id));

        if($alumno instanceof Alumno) {
            $em->remove($alumno);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $alumno = $this->editEntity($request, $id);
            if($alumno != null) {
                return $this->render('BoletinesBundle:Alumno:show.html.twig', array('alumno' => $alumno));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $padres = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $id));
        }

        return $this->render('BoletinesBundle:Alumno:edit.html.twig', array('alumno' => $alumno, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas, 'padres'=> $padres));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $id));

        $alumno->setNombreAlumno($data->request->get('nombreAlumno'));

        $idUsuarioAlumno = $data->request->get('idUsuarioAlumno');
        if($idUsuarioAlumno > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioAlumno));
            $alumno->setUsuarioAlumno($entityRelacionada);
        }
        $idUsuarioPadre1 = $data->request->get('idUsuarioPadre1');
        if($idUsuarioPadre1 > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre1));
            $alumno->setUsuarioPadre1($entityRelacionada);
        }
        $idUsuarioPadre2 = $data->request->get('idUsuarioPadre2');
        if($idUsuarioPadre2 > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre2));
            $alumno->setUsuarioPadre2($entityRelacionada);
        }

        $em->persist($alumno);
        $em->flush();

        return $alumno;
    }
}

