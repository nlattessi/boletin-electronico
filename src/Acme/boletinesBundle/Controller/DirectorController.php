<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DirectorController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();

        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $cantidadAlumnos = count($muchosAMuchos->obtenerAlumnosPorEstablecimientos($establecimientos));
        $cantidadPadres = count($muchosAMuchos->obtenerPadresPorEstablecimientos($establecimientos));
        $cantidadDocentes = count($muchosAMuchos->obtenerDocentesPorEstablecimientos($establecimientos));
        $cantidadBedeles = count($muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_BEDEL'));
        $cantidadDirectivos = count($muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_DIRECTIVO'));
        $cantidadAdmins = count($muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_ADMIN'));

        $roles = array(
          'alumnos' => $cantidadAlumnos,
          'padres' => $cantidadPadres,
          'docentes' => $cantidadDocentes,
          'bedeles' => $cantidadBedeles,
          'directivos' => $cantidadDirectivos,
          'admins' => $cantidadAdmins
        );

        return $this->render('BoletinesBundle:Director:role_directivo.html.twig', array('roles' => $roles));
    }

    public function getAlumnosAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $alumnos = $muchosAMuchos->obtenerAlumnosPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:alumnos.html.twig', array('alumnos' => $alumnos));
    }

    public function getDocentesAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $docentes = $muchosAMuchos->obtenerDocentesPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:docentes.html.twig', array('docentes' => $docentes));
    }

    public function getPadresAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $padres = $muchosAMuchos->obtenerPadresPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:padres.html.twig', array('padres' => $padres));
    }

    public function getBedelesAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $bedeles = $muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_BEDEL');

        return $this->render('BoletinesBundle:Director:bedeles.html.twig', array('bedeles' => $bedeles));
    }

    public function getMateriasAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $bedeles = $muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_BEDEL');

        return $this->render('BoletinesBundle:Director:bedeles.html.twig', array('bedeles' => $bedeles));
    }

}
