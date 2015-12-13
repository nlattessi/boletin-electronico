<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BullyingController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bullyings = $em->getRepository('BoletinesBundle:Bullying')->findAll();

        $data = [];
        foreach ($bullyings as $bullying) {
            if ($bullying->getAlumno()->getUsuario()->getInstitucion() == $this->getUser()->getInstitucion()) {
                $data[] = $bullying;
            }
        }
        return $this->render('BoletinesBundle:Bullying:index.html.twig', ['bullyings' => $data]);
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $bullying = $em->getRepository('BoletinesBundle:Bullying')->find($id);

        return $this->render('BoletinesBundle:Bullying:show.html.twig', ['bullying' => $bullying]);
    }
}
