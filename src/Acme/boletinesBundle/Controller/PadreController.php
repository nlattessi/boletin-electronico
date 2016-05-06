<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Padre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\UsuarioEstablecimiento;
use Symfony\Component\HttpFoundation\Request;
use Acme\boletinesBundle\Entity\Calendario;

class PadreController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $padresService =  $this->get('boletines.servicios.padre');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $padres = $muchosAMuchos->obtenerPadresPorEstablecimientos($establecimientos);
        foreach($padres as $padre){
            $padresService->cargarHijos($padre);
        }

        return $this->render('BoletinesBundle:Padre:index.html.twig', array('padres' => $padres,
            'css_active' => 'padre',));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $padre = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $id));
        $padresService =  $this->get('boletines.servicios.padre');
        $padresService->cargarHijos($padre);

        return $this->render('BoletinesBundle:Padre:show.html.twig', array('padre' => $padre));
    }

    public function newAction(Request $request)
    {
        $message = "";
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {
            $padre = $this->createEntity($request);
            $padresService =  $this->get('boletines.servicios.padre');
            $padresService->cargarHijos($padre);

            return $this->render('BoletinesBundle:Padre:show.html.twig', array('padre' => $padre));
        }
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        $paises = $em->getRepository('BoletinesBundle:Pais')->findAll();
        $ciudades = $em->getRepository('BoletinesBundle:Ciudad')->findAll();

        return $this->render(
            'BoletinesBundle:Padre:new.html.twig',
            array(
                'establecimientos' => $establecimientos,
                'paises' => $paises,
                'ciudades' => $ciudades,
                'css_active' => 'padre',
            )
        );
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));
        $user = new Usuario();
        $user->setNombre($data->request->get('nombre'));
        $user->setPassword($data->request->get('password'));
        $user->setDni($data->request->get('dni'));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));
        $user->setEmail($data->request->get('email'));
        $rolPadre = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('nombre' => 'ROLE_PADRE'));
        $user->setRol($rolPadre);
        $user->setApellido($data->request->get('apellido'));
        $user->setInstitucion($this->getUser()->getInstitucion());

        $em->persist($user);
        $em->flush();


        $padre = new Padre();
        $padre->setNombre($data->request->get('nombre'));
        $padre->setApellido($data->request->get('apellido'));
        $padre->setDni($data->request->get('dni'));
//        $padre->set($data->request->get('sexo'));

        $padre->setDireccion($data->request->get('direccion'));
        $padre->setCodigoPostal($data->request->get('postal'));
        $padre->setCodigoArea($data->request->get('codarea'));
        $padre->setTelefono($data->request->get('telefono'));
        $padre->setCelular($data->request->get('celular'));
        $padre->setTelefonoLaboral($data->request->get('telefonoLaboral'));

        $padre->setObservaciones($data->request->get('obs'));

        $ciudad = $em->getRepository('BoletinesBundle:Ciudad')->findOneBy(array('id' => $data->request->get('ciudad')));
        $padre->setCiudad($ciudad);
        //$padre->setOcupacion($data->request->get('ocupacion'));
        $padre->setUsuario($user);
        $padre->setCreationTime(new \DateTime() );
        $padre->setUpdateTime(new \DateTime() );
        $padre->setEstablecimiento($establecimiento);
        $em->persist($padre);
        $em->flush();

        $user->setIdEntidadAsociada($padre->getId());
        $em->persist($user);

        $userEstablecimiento = new UsuarioEstablecimiento();

        $userEstablecimiento->setEstablecimiento($establecimiento);
        $userEstablecimiento->setUsuario($user);
        $em->persist($userEstablecimiento);
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
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $padre = $this->editEntity($request, $id);
            if($padre != null) {
                return $this->render('BoletinesBundle:Padre:show.html.twig', array('padre' => $padre));
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $padre = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $id));

        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        $paises = $em->getRepository('BoletinesBundle:Pais')->findAll();
        $ciudades = $em->getRepository('BoletinesBundle:Ciudad')->findAll();

        return $this->render('BoletinesBundle:Padre:edit.html.twig', array('padre' => $padre,
            'establecimientos' => $establecimientos,
            'paises' => $paises,
            'ciudades' => $ciudades,
            'mensaje' => $message,
            'css_active' => 'padre',
            ));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $padre = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $id));
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $data->request->get('establecimiento')));

        $user = $padre->getUsuario();
        $user->setNombre($data->request->get('nombre'));
        $user->setPassword($data->request->get('password'));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));
        $user->setEmail($data->request->get('email'));

        $user->setApellido($data->request->get('apellido'));

        $em->persist($user);
        $em->flush();

        $padre->setNombre($data->request->get('nombre'));
        $padre->setApellido($data->request->get('apellido'));
        $padre->setDni($data->request->get('dni'));
//        $padre->set($data->request->get('sexo'));

        $padre->setDireccion($data->request->get('direccion'));
        $padre->setCodigoPostal($data->request->get('postal'));
        $padre->setCodigoArea($data->request->get('codarea'));
        $padre->setTelefono($data->request->get('telefono'));
        $padre->setCelular($data->request->get('celular'));
        $padre->setTelefonoLaboral($data->request->get('telefonoLaboral'));

        $padre->setObservaciones($data->request->get('obs'));

        $ciudad = $em->getRepository('BoletinesBundle:Ciudad')->findOneBy(array('id' => $data->request->get('ciudad')));
        $padre->setCiudad($ciudad);
        //$padre->setOcupacion($data->request->get('ocupacion'));

        $padre->setUpdateTime(new \DateTime() );
        $padre->setEstablecimiento($establecimiento);


        $em->persist($padre);
        $em->flush();

        return $padre;
    }

    public function deleteDirectorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $padre = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $id));

        if($padre instanceof Padre) {
//            if($this->getUser()->getInstitucion() == $alumno->getEstablecimiento()->getInstitucion()
//            && $this->getUser()->getRol()->getName == 'ROLE_DIRECTOR') {
                $em->remove($padre);
                $em->flush();
            }
//        }
        return new RedirectResponse($this->generateUrl('directivo_padres'));
    }

}

