<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\UsuarioEstablecimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class BedelController extends Controller
{

    public function addAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $this->createBedel($request);
        }

        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        return $this->render('BoletinesBundle:Bedel:new.html.twig', array('establecimientos' => $establecimientos));
    }

    private function createBedel($data)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new Usuario();
        $user->setEmail($data->request->get('email'));
        $user->setNombre($data->request->get('user'));
        $user->setPassword($data->request->get('password'));
        $user->setApellido($data->request->get('apellido'));
        $rolBedel = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('nombre' => 'ROLE_BEDEL'));
        $user->setRol($rolBedel);
        $user->setInstitucion($this->getUser()->getInstitucion());
        $user->setCreationTime(new \DateTime());

        $em->persist($user);
        $em->flush();

        $userEstablecimiento = new UsuarioEstablecimiento();
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $userEstablecimiento->setEstablecimiento($establecimiento);
        $userEstablecimiento->setUsuario($user);

        $em->persist($userEstablecimiento);
        $em->flush();

        return $user;
    }


}
