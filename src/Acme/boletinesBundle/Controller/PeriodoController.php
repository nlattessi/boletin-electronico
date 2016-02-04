<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Acme\boletinesBundle\Entity\Periodo;
use Acme\boletinesBundle\Entity\PeriodoEstablecimiento;
use Acme\boletinesBundle\Utils\Herramientas;


class PeriodoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if ($this->getUser()->getRol()->getNombre() == 'ROLE_DIRECTIVO') {
            $user = $this->getUser();
            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
            $periodos = $muchosAMuchos->obtenerPeriodosPorEstablecimientos($establecimientos);
        } else {
            return $this->redirect($this->generateUrl('home', [], 301));
        }

        return $this->render('BoletinesBundle:Periodo:index.html.twig', ['periodos' => $periodos]);
    }

    public function newAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $periodo = $this->createPeriodo($request->request);

            if ($periodo instanceof Periodo) {
                $this->get('session')->getFlashBag()->add('success', 'Nuevo periodo creado con éxito');

                return $this->redirect($this->generateUrl('periodo', [], 301));
            }
        }

        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        return $this->render('BoletinesBundle:Periodo:new.html.twig', ['establecimientos' => $establecimientos]);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository('BoletinesBundle:Periodo')->find($id);

        if ($periodo instanceof Periodo) {
          $em->remove($periodo);
          $em->flush();

          $this->get('session')->getFlashBag()->add('success', 'El periodo se removió con éxito');
        }

        return $this->redirect($this->generateUrl('periodo', [], 301));
    }

    public function getOneAction()
    {

    }

    public function editAction($id, Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $periodo = $this->editPeriodo($id, $request->request);

            if ($periodo instanceof Periodo) {
                $this->get('session')->getFlashBag()->add('success', 'El periodo se actualizó con éxito');

                return $this->redirect($this->generateUrl('periodo', [], 301));
            }
        }

        $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository('BoletinesBundle:Periodo')->find($id);
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        return $this->render('BoletinesBundle:Periodo:edit.html.twig', ['periodo' => $periodo, 'establecimientos' => $establecimientos]);
    }

    private function createPeriodo($data)
    {
        $em = $this->getDoctrine()->getManager();

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->find($data->get('establecimiento'));

        $periodo = new Periodo();
        $periodo->setNombre($data->get('nombre'));
        $periodo->setEstablecimiento($establecimiento);
        $periodo->setFechaDesde(Herramientas::textoADatetime($data->get('fecha_desde')));
        $periodo->setFechaHasta(Herramientas::textoADatetime($data->get('fecha_hasta')));
        //$periodo->setCreationTime(new \DateTime('now'));
        //$periodo->setUpdateTime(new \DateTime('now'));

        $em->persist($periodo);

        $em->flush();

        return $periodo;
    }

    private function editPeriodo($id, $data)
    {
        $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository('BoletinesBundle:Periodo')->find($id);

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->find($data->get('establecimiento'));

        $periodo->setNombre($data->get('nombre'));
        $periodo->setEstablecimiento($establecimiento);
        $periodo->setFechaDesde(Herramientas::textoADatetime($data->get('fecha_desde')));
        $periodo->setFechaHasta(Herramientas::textoADatetime($data->get('fecha_hasta')));
        $periodo->setUpdateTime(new \DateTime('now'));

        $em->persist($periodo);

        $em->flush();

        return $periodo;
    }
}
