<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\UsuarioType;

class HomeController extends Controller
{

    public function fatherAction()
    {
        return $this->render('BoletinesBundle:Home:father.html.twig', array());
    }

    public function fatherAsistenciaAction()
    {
        return $this->render('BoletinesBundle:Home:father.asistencia.html.twig', array());
    }

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $instituciones = $em->getRepository('BoletinesBundle:Institucion')->findAll();
        $institucionesCount = count($instituciones);

        $alumnos = $em->getRepository('BoletinesBundle:Alumno')->findAll();
        $alumnosCount = count($alumnos);

        $alumnosCount = 7650; //HARDCODEADO PARA DEMO2

        return $this->render('BoletinesBundle:Home:admin.html.twig', array('institucionesCount' => $institucionesCount, 'alumnosCount' => $alumnosCount));
    }

    public function inst_manuel_belgranoAction()
    {
        return $this->render('BoletinesBundle:Home:inst_manuel_belgrano.html.twig', array());
    }

    public function inst_belgrano_day_schoolAction()
    {
        return $this->render('BoletinesBundle:Home:inst_belgrano_day_school.html.twig', array());
    }

    public function under_constructionAction()
    {
        return $this->render('BoletinesBundle:Home:under_construction.html.twig', array());
    }

    public function alumnoAction()
    {
        return $this->render('BoletinesBundle:Home:alumno.html.twig', array());
    }

    public function alumnoAsistenciaAction()
    {
        return $this->render('BoletinesBundle:Home:alumno.asistencia.html.twig', array());
    }

    public function directivoAlumnosAction()
    {
        return $this->render('BoletinesBundle:Home:directivo.alumnos.html.twig', array());
    }

    public function directivoAlumnoDatosAction()
    {
        return $this->render('BoletinesBundle:Home:directivo.alumno.datos.html.twig', array());
    }

    public function directivoAlumnoEditarAction()
    {
        return $this->render('BoletinesBundle:Home:directivo.alumno.editar.html.twig', array());
    }
}
