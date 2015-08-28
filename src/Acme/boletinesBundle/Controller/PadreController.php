<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Padre;
use Symfony\Component\HttpFoundation\RedirectResponse;


class PadreController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();

        $padres = [];
        foreach ($establecimientos as $establecimiento) {
            foreach ($establecimiento->getPadres() as $padre) {
                $padres[] = $padre;
            }
        }

        return $this->render('BoletinesBundle:Padre:index.html.twig', array(
            'institucion' => $this->getUser()->getInstitucion(),
            'padres' => $padres
        ));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $padre = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Padre:show.html.twig', array('padre' => $padre));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $padre = $this->createEntity($request);

            if($padre != null) {
                return new RedirectResponse($this->generateUrl('padre', array()));
            } else {
                $message = "Errores";
            }
        }else{
            $establecimientos = $this->getUser()->getInstitucion()->getEstablecimientos();
        }

        return $this->render('BoletinesBundle:Padre:new.html.twig', array(
          'establecimientos' => $establecimientos
        ));
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $padre = new Padre();
        $padre->setNombre($data->request->get('nombre'));
        $padre->setApellido($data->request->get('apellido'));
        $padre->setDni($data->request->get('dni'));
        $padre->setTelefono($data->request->get('telefono'));
        $padre->setCelular($data->request->get('celular'));
        $padre->setTelefonoLaboral($data->request->get('telefonoLaboral'));

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $padre->setEstablecimiento($establecimiento);

        $em->persist($padre);
        $em->flush();

        return $padre;
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $padre = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $id));

        if($padre instanceof Padre) {
            $em->remove($padre);
            $em->flush();
        }

        return new RedirectResponse($this->generateUrl('padre', array()));
    }


    public function editAction($id = null, Request $request = null)
    {
    }

    private function editEntity($data, $id)
    {
    }
}
