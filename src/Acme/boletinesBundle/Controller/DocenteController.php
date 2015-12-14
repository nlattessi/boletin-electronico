<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\UsuarioEstablecimiento;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\boletinesBundle\Entity\Docente;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Utils\Herramientas;
use Symfony\Component\HttpFoundation\RedirectResponse;


class DocenteController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $docentes = $muchosAMuchos->obtenerDocentesPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Docente:index.html.twig', array('docentes' => $docentes,
            'css_active' => 'docente'));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Docente:show.html.twig', array('docente' => $docente));
    }

    public function newAction(Request $request)
    {
        $message = "";
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {
            $docente = $this->createEntity($request);
            if($docente instanceof Docente) {
                return $this->render('BoletinesBundle:Docente:show.html.twig', array('docente' => $docente));
            }
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
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
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
        $docente->setEstablecimiento($establecimiento);
        $em->persist($docente);
        $em->flush();

        $user->setIdEntidadAsociada($docente->getId());
        $em->persist($user);

        $userEstablecimiento = new UsuarioEstablecimiento();

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
        }
        $em = $this->getDoctrine()->getManager();
        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('id' => $id));
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $paises = $em->getRepository('BoletinesBundle:Pais')->findAll();
        $ciudades = $em->getRepository('BoletinesBundle:Ciudad')->findAll();

        return $this->render('BoletinesBundle:Docente:edit.html.twig',
            array(
                'docente' => $docente,
                'establecimientos' => $establecimientos,
                'paises' => $paises,
                'ciudades' => $ciudades
            )
        );
    }

    private function editEntity($request, $id)
    {
        $data = $request->request->all();

//        var_dump($data);exit;
        $em = $this->getDoctrine()->getManager();
        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('id' => $id));
        $docente->setNombre($data['nombre']);
        $docente->setApellido($data['apellido']);
        $docente->setDni($data['dni']);
        if ($data['bdate'] != '') {
            $docente->setFechaNacimiento(
                Herramientas::textoADatetime($data['bdate'])
            );
        }

        if ($data['ingresodate'] != '') {
            $docente->setFechaIngreso(
                Herramientas::textoADatetime($data['ingresodate'])
            );
        }
        $docente->setDireccion($data['direccion']);
        $docente->setCodigoPostal($data['postal']);
        $docente->setCodigoPais($data['codpais']);
        $docente->setCodigoArea($data['codarea']);
        $docente->setTelefono($data['telefono']);
        $docente->setObservaciones($data['obs']);
        $docente->setTitulo($data['titulouniversitario']);
        $docente->setEsTitular(isset($data['titular']));
        $docente->getUsuario()->setEmail($data['email']);
        if (isset($data['ciudad'])) {
            $ciudad = $em->getRepository('BoletinesBundle:Ciudad')->findOneBy(array('id' => $data['ciudad']));
            $docente->setCiudad($ciudad);
        }

        $em->persist($docente);
        $em->flush();

        return $docente;
    }
}

