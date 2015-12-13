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

        return $this->render('BoletinesBundle:Director:alumnos.html.twig', array('alumnos' => $alumnos, 'establecimientos' => $establecimientos,
            'css_active' => 'establecimiento',));
    }

    public function getDocentesAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $docentes = $muchosAMuchos->obtenerDocentesPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:docentes.html.twig', array('docentes' => $docentes,
            'css_active' => 'docente',));
    }

    public function getPadresAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $padres = $muchosAMuchos->obtenerPadresPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:padres.html.twig', array('padres' => $padres,
            'css_active' => 'padre',));
    }

    public function getBedelesAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $bedeles = $muchosAMuchos->obtenerUsuariosPorRolPorEstablecimientos($establecimientos, 'ROLE_BEDEL');

        return $this->render('BoletinesBundle:Director:bedeles.html.twig', array('bedeles' => $bedeles,
            'css_active' => 'bedel',));
    }

    public function getMateriasAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $materias = $muchosAMuchos->obtenerMateriasPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:materias.html.twig', array('materias' => $materias,
            'css_active' => 'materia',));
    }

    public function getCalificacionesAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $calificaciones = $muchosAMuchos->obtenerCalificacionesPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:calificaciones.html.twig', array('calificaciones' => $calificaciones,
            'css_active' => 'calificacion',));
    }

    public function getGruposUsuarioAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $grupos = $muchosAMuchos->obtenerGruposPorEstablecimientos($establecimientos);

//        foreach($grupos as $grupo) {
//
//            $usuariosGrupos = $em->getRepository('BoletinesBundle:UsuarioGrupoUsuario')->findBy(array('grupoUsuario' => $grupo));
//            var_dump(count($grupo->getUsuarios()));
//
////            $grupo->setCantUsuarios(count($usuariosGrupos));
//        }
//exit();
        return $this->render('BoletinesBundle:Director:grupos.html.twig', array('grupos' => $grupos,
            'css_active' => 'grupoUsuario',));
    }

    public function getGruposAlumnosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $grupos = $muchosAMuchos->obtenerGruposAlumnosPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:Director:gruposAlumnos.html.twig', array('gruposAlumnos' => $grupos,
            'css_active' => 'grupoAlumno',));
    }

    public function getConvivenciaAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $convivencias = $muchosAMuchos->obtenerConvivenciaPorEstablecimientos($establecimientos);


        return $this->render('BoletinesBundle:Director:convivencia.html.twig', array('convivencias' => $convivencias,
            'css_active' => 'convivencia',));
    }


}
