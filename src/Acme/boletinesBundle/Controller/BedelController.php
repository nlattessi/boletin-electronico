<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\UsuarioEstablecimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BedelController extends Controller
{

    public function addAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $bedel = $this->createBedel($request);
            if($bedel instanceof Usuario) {
                return $this->redirect($this->generateUrl('bedel_edit', array('id' => $bedel->getId())));
            }
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

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $bedel = $this->editEntity($request, $id);
        }

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $bedel = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Bedel:edit.html.twig', array('bedel' => $bedel, 'establecimientos' => $establecimientos));
    }

    private function editEntity($request, $id)
    {
        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $bedel = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));
        $bedel->setNombre($data['user']);
        $bedel->setApellido($data['apellido']);
        $bedel->setEmail($data['email']);
        $bedel->setPassword($data['password']);

        $em->persist($bedel);
        $em->flush();

        return $bedel;
    }

}
