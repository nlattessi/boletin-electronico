<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BoletinController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if ($this->getUser()->getRol()->getNombre() == 'ROLE_DOCENTE') {
            $materiaService =  $this->get('boletines.servicios.materia');
            $request = $this->getRequest();
            $session = $request->getSession();
            $docente = $session->get('docenteActivo');
            $materias = $materiaService->listaMateriasPorDocente($docente->getId());
        }

        return $this->render('BoletinesBundle:Boletin:index.html.twig', [
            'css_active' => 'boletin',
            'materias' => $materias
        ]);
    }

    public function cargarNotaAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $materia = $em->getRepository('BoletinesBundle:Materia')->find($id);

        if ($materia) {
            $materiaService =  $this->get('boletines.servicios.materia');
            $materia = $materiaService->materiaLoad($materia);
        }

        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimiento = $this->getRequest()->getSession()->get('establecimientoActivo');
        $periodos = $muchosAMuchos->obtenerPeriodosPorEstablecimiento($establecimiento);

        return $this->render('BoletinesBundle:Boletin:cargar_notas.html.twig', [
            'css_active' => 'boletin',
            'materia' => $materia,
            'periodos' => $periodos
        ]);
    }
}
