<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\UsuarioEstablecimiento;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Docente;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\DocenteType;

class DocenteController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Docente')->findAll();

        return $this->render('BoletinesBundle:Docente:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));

        return $this->render('BoletinesBundle:Docente:show.html.twig', array('docente' => $docente));
    }

    public function newAction(Request $request)
    {
        $message = "";
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {
            $docente = $this->createEntity($request);
        }
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        $paises = $em->getRepository('BoletinesBundle:Pais')->findAll();
        $ciudades = $em->getRepository('BoletinesBundle:Ciudad')->findAll();

        return $this->render(
            'BoletinesBundle:Docente:new.html.twig',
            array(
                'establecimientos' => $establecimientos,
                'paises' => $paises,
                'ciudades' => $ciudades
            )
        );
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new Usuario();
        $user->setNombre($data->request->get('user'));
        $user->setPassword($data->request->get('password'));
        $user->setEmail($data->request->get('email'));
        $rolBedel = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('nombre' => 'ROLE_DOCENTE'));
        $user->setRol($rolBedel);
        $user->setApellido($data->request->get('apellido'));
        $user->setInstitucion($this->getUser()->getInstitucion());

        $em->persist($user);
        $em->flush();


        $docente = new Docente();
        $docente->setNombre($data->request->get('nombre'));
        $docente->setApellido($data->request->get('apellido'));
        $docente->setDni($data->request->get('dni'));
//        $docente->set($data->request->get('sexo'));
        $docente->setFechaNacimiento(
            new \DateTime($data->request->get('bdate'))
        );
        $docente->setFechaIngreso(
            new \DateTime($data->request->get('ingresodate'))
        );
        $docente->setDireccion($data->request->get('direccion'));
        $docente->setCodigoPostal($data->request->get('postal'));
        $docente->setCodigoPais($data->request->get('codpais'));
        $docente->setCodigoArea($data->request->get('codarea'));
        $docente->setTelefono($data->request->get('telefono'));
//        $docente->set($data->request->get('telefonoem'));
        $docente->setEsTitular($data->request->get('titular'));
        $docente->setObservaciones($data->request->get('obs'));

        $ciudad = $em->getRepository('BoletinesBundle:Ciudad')->findOneBy(array('id' => $data->request->get('ciudad')));
        $docente->setCiudad($ciudad);
        $docente->setTitulo($data->request->get('titulouniversitario'));
        $docente->setUsuario($user);
        $docente->setCreationTime(new \DateTime() );
        $docente->setUpdateTime(new \DateTime() );
        $em->persist($docente);
        $em->flush();

        $userEstablecimiento = new UsuarioEstablecimiento();
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $userEstablecimiento->setEstablecimiento($establecimiento);
        $userEstablecimiento->setUsuario($user);

        $em->persist($userEstablecimiento);
        $em->flush();


        return $docente;
    }

    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));

        if($docente instanceof Docente) {
            $em->remove($docente);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $docente = $this->editEntity($request, $id);
            if($docente != null) {
                return $this->render('BoletinesBundle:Docente:show.html.twig', array('docente' => $docente));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));
        }

        return $this->render('BoletinesBundle:Docente:edit.html.twig', array('docente' => $docente, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));

        $docente->setNombreDocente($data->request->get('nombreDocente'));
        $docente->setEmailDocente($data->request->get('emailDocente'));
        $docente->setTelefonoDocente($data->request->get('telefonoDocente'));
        $idUsuario = $data->request->get('idUsuario');
        if($idUsuario > 0){
            $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' =>$idUsuario ));
            $docente->setUsuario($usuario);
        }else{
            //no seleccionó ninguno
            if($docente->getUsuario() == null) {
                //no tenia ninguno
                $controllerUsuario = new UsuarioController();
                $usuario = $controllerUsuario->crearUsuarioDocente($docente->getNombreDocente(), $docente->getEmailDocente());
                $em->persist($usuario);
                $docente->setUsuario($usuario);
            }
        }


        $em->persist($docente);
        $em->flush();

        return $docente;
    }
}

