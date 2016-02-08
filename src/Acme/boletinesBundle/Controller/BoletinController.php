<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Acme\boletinesBundle\Entity\NotaPeriodo;


class BoletinController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if ($this->getUser()->getRol()->getNombre() == 'ROLE_DOCENTE') {
            $materiaService =  $this->get('boletines.servicios.materia');
            $docente = $this->getRequest()->getSession()->get('docenteActivo');
            $materias = $materiaService->listaMateriasPorDocente($docente->getId());

            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimiento = $this->getRequest()->getSession()->get('establecimientoActivo');
            $periodos = $muchosAMuchos->obtenerPeriodosPorEstablecimiento($establecimiento);
        }

        return $this->render('BoletinesBundle:Boletin:index.html.twig', [
            'css_active' => 'boletin',
            'materias' => $materias,
            'periodos' => $periodos
        ]);
    }

    public function cargarNotaAction($materiaId, $periodoId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {
            $materia = $em->getRepository('BoletinesBundle:Materia')->find($materiaId);
            $periodo = $em->getRepository('BoletinesBundle:Periodo')->find($periodoId);
            $notasPeriodo = $em->getRepository('BoletinesBundle:NotaPeriodo')->findBy([
                'materia' => $materia,
                'periodo' => $periodo
            ]);

            foreach ($notasPeriodo as $notaPeriodo) {
                $valorId = $request->request->get($notaPeriodo->getId() . 'nota');
                $comentario = $request->request->get($notaPeriodo->getId() . 'comentario');
                $notaPeriodo->setNota($em->getRepository('BoletinesBundle:ValorCalificacion')->findOneBy(['id' => $valorId]));
                $notaPeriodo->setComentario($comentario);
                $em->persist($notaPeriodo);
            }
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Se cargaron las notas con éxito');
            return $this->redirect($this->generateUrl('boletin_cargar_nota', ['materiaId' => $materiaId, 'periodoId' => $periodoId]), 301);
        }

        $establecimiento = $this->getRequest()->getSession()->get('establecimientoActivo');

        $materia = $em->getRepository('BoletinesBundle:Materia')->find($materiaId);

        if ($materia) {
            $materiaService =  $this->get('boletines.servicios.materia');
            $materia = $materiaService->materiaLoad($materia);
        }

        $periodo = $em->getRepository('BoletinesBundle:Periodo')->find($periodoId);

        $calificacionService =  $this->get('boletines.servicios.calificacion');
        $valoresCalificacion = $calificacionService->valoresAceptados($establecimiento);

        $calificaciones = [];
        foreach ($materia->getEvaluaciones() as $evaluacion) {
            if ($evaluacion->getPeriodo() == $periodo) {
                $calificacion = $calificacionService->obtenerCalificacionesPorEvaluacion($evaluacion);
                if ($calificacion) $calificaciones[] = $calificacion;
            }
        }

        $evaluacionesPeriodo = $em->getRepository('BoletinesBundle:Evaluacion')->findBy([
            'materia' => $materia,
            'periodo' => $periodo,
            'activo' => true
        ]);

        $notasSugeridas = [];

        $gruposAlumnos = $materia->getGruposAlumnos();
        foreach ($gruposAlumnos as $grupo) {
            foreach ($grupo->getAlumnos() as $alumno) {

                $np = $em->getRepository('BoletinesBundle:NotaPeriodo')->findOneBy([
                    'materia' => $materia,
                    'periodo' => $periodo,
                    'alumno' => $alumno
                ]);

                if (! $np) {
                  $notaPeriodo = new NotaPeriodo();
                  $notaPeriodo->setMateria($materia);
                  $notaPeriodo->setPeriodo($periodo);
                  $notaPeriodo->setAlumno($alumno);
                  $em->persist($notaPeriodo);
                }

                $calificacionesAlumno = [];
                $esquemaCalificacion = null;
                foreach ($evaluacionesPeriodo as $ep) {
                    foreach ($calificaciones as $calificacion) {
                        foreach ($calificacion as $c) {
                            if ($c->getEvaluacion() == $ep && $c->getAlumno() == $alumno) {
                                $calificacionesAlumno[] = $c->getValor();
                                $esquemaCalificacion = ($esquemaCalificacion == null) ? $c->getValor()->getEsquemaCalificacion() : $esquemaCalificacion;
                            }
                        }
                    }
                }
                $notaSugerida = 0;
                foreach ($calificacionesAlumno as $calificacionAlumno) {
                    $notaSugerida += $calificacionAlumno->getValor();
                }
                $notaSugerida = $notaSugerida / sizeof($calificacionesAlumno);
                $valorCalificacion = $em->getRepository('BoletinesBundle:ValorCalificacion')->findOneBy([
                    'esquemaCalificacion' => $esquemaCalificacion,
                    'valor' => $notaSugerida
                ]);
                $notasSugeridas[] = ['alumno' => $alumno, 'valorCalificacion' => $valorCalificacion];
            }
        }
        $em->flush();

        $notasPeriodo = $em->getRepository('BoletinesBundle:NotaPeriodo')->findBy([
            'materia' => $materia,
            'periodo' => $periodo
        ]);

        return $this->render('BoletinesBundle:Boletin:cargar_notas.html.twig', [
            'css_active' => 'boletin',
            'materia' => $materia,
            'periodo' => $periodo,
            'valoresCalificacion' => $valoresCalificacion,
            'notasPeriodo' => $notasPeriodo,
            'evaluacionesPeriodo' => $evaluacionesPeriodo,
            'calificaciones' => $calificaciones,
            'notasSugeridas' => $notasSugeridas
        ]);
    }
}
