<?php

namespace Acme\boletinesBundle\Controller;

//use Proxies\__CG__\Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\Usuario;
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

    public function addFromDirectorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        /* Por qué el nombre así
        $usuario->setNombre(
            $request->request->get('nombre')
            . '.' .
            $request->request->get('apellido')
        );*/
        $usuario->setNombre($request->request->get('nombre'));
        $usuario->setApellido($request->request->get('apellido'));
        $usuario->setPassword($request->request->get('apellido'));
        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('nombre' => 'ROLE_ALUMNO'));
        $usuario->setRol($rol);
        $usuario->setInstitucion($this->getUser()->getInstitucion());
        $em->persist($usuario);
        $em->flush();

        $alumno = new Alumno();
        $alumno->setNombre($request->request->get('nombre'));
        $alumno->setApellido($request->request->get('apellido'));
        $alumno->setDni($request->request->get('dni'));
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')
            ->findOneBy(array('id' => $request->request->get('establecimiento')));

        $alumno->setEstablecimiento($establecimiento);
        $alumno->setUsuario($usuario);

        $em->persist($alumno);

        $em->flush();

        $usuario->setIdEntidadAsociada($alumno->getId());
        $em->persist($usuario);
        $em->flush();

        return new RedirectResponse($this->generateUrl('director_alumnos'));
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

    public function deleteDirectorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $id));

        if($alumno instanceof Alumno) {
//            if($this->getUser()->getInstitucion() == $alumno->getEstablecimiento()->getInstitucion()
//            && $this->getUser()->getRol()->getName == 'ROLE_DIRECTOR') {
                $em->remove($alumno);
                $em->flush();
            }
//        }
        return new RedirectResponse($this->generateUrl('director_alumnos'));
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

    public function antybullyngAction($id, Request $request = null){
        //notificar Directivo
        return $this->redirect($request->headers->get('referer'));
    }
}

