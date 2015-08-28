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
use Symfony\Component\HttpFoundation\RedirectResponse;

class AlumnoController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        // $entities = $em->getRepository('BoletinesBundle:Alumno')->findAll();

        // return $this->render('BoletinesBundle:Alumno:index.html.twig', array('entities' => $entities));

        $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();

        $alumnos = [];
        foreach ($establecimientos as $establecimiento) {
            foreach ($establecimiento->getAlumnos() as $alumno) {
                $alumnos[] = $alumno;
            }
        }

        return $this->render('BoletinesBundle:Alumno:index2.html.twig', array(
            'institucion' => $this->getUser()->getInstitucion(),
            'alumnos' => $alumnos
        ));
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
                // return $this->render('BoletinesBundle:Alumno:show.html.twig', array('alumno' => $alumno));
                return new RedirectResponse($this->generateUrl('alumno', array()));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            // $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            // $padres = $em->getRepository('BoletinesBundle:Usuario')->findAll();

            $especialidades = [];
            $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();

            foreach ($establecimientos as $establecimiento) {
                foreach ($establecimiento->getEspecialidades() as $especialidad) {
                    $especialidades[] = $especialidad;
                }
            }

            $padres = $em->getRepository('BoletinesBundle:Padre')->findAll();
        }

        // return $this->render('BoletinesBundle:Alumno:new2.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas, 'padres'=> $padres));
        return $this->render('BoletinesBundle:Alumno:new2.html.twig', array(
          'establecimientos' => $establecimientos,
          'especialidades' => $especialidades,
          'padres'=> $padres
        ));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        // $alumno = new Alumno();
        // $alumno->setNombreAlumno($data->request->get('nombreAlumno'));
        // $idUsuarioAlumno = $data->request->get('idUsuarioAlumno');
        // if($idUsuarioAlumno > 0){
        //     //Selecciono una UsuarioAlumno
        //     $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioAlumno));
        //     $alumno->setUsuarioAlumno($entityRelacionada);
        // }
        // $idUsuarioPadre1 = $data->request->get('idUsuarioPadre1');
        // if($idUsuarioPadre1 > 0){
        //     //Selecciono una UsuarioAlumno
        //     $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre1));
        //     $alumno->setUsuarioPadre1($entityRelacionada);
        // }
        // $idUsuarioPadre2 = $data->request->get('idUsuarioPadre2');
        // if($idUsuarioPadre2 > 0){
        //     //Selecciono una UsuarioAlumno
        //     $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre2));
        //     $alumno->setUsuarioPadre2($entityRelacionada);
        // }

        $alumno = new Alumno();
        $alumno->setNombre($data->request->get('nombre'));
        $alumno->setApellido($data->request->get('apellido'));
        $alumno->setDni($data->request->get('dni'));
        $alumno->setTelefono($data->request->get('telefono'));
        $alumno->setDireccion($data->request->get('direccion'));
        $alumno->setCodigoPostal($data->request->get('codigoPostal'));
        $alumno->setCodigoPais($data->request->get('codigoPais'));
        $alumno->setCodigoArea($data->request->get('codigoArea'));
        $alumno->setObraSocial($data->request->get('obraSocial'));
        $alumno->setObraSocialNumeroAfiliado($data->request->get('obraSocialNumeroAfiliado'));
        $alumno->setTelefonoEmergencia($data->request->get('telefonoEmergencia'));
        $alumno->setAvatarId(1);
        $alumno->setFechaIngreso(new \DateTime($data->request->get('fechaIngreso')));
        $alumno->setFechaNacimiento(new \DateTime($data->request->get('fechaNacimiento')));

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $alumno->setEstablecimiento($establecimiento);

        $especialidad = $em->getRepository('BoletinesBundle:Especialidad')->findOneBy(array('id' => $data->request->get('especialidad')));
        $alumno->setEspecialidad($especialidad);

        $padre1 = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $data->request->get('padre_1')));
        $alumno->setPadre1($padre1);
        $padre2 = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $data->request->get('padre_2')));
        $alumno->setPadre2($padre2);

        $em->persist($alumno);
        $em->flush();

        return $alumno;
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $id));

        if($alumno instanceof Alumno) {
            $em->remove($alumno);
            $em->flush();
        }

        return new RedirectResponse($this->generateUrl('alumno', array()));
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
