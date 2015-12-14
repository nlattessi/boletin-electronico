<?php

namespace Acme\boletinesBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\GrupoUsuario;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\GrupoUsuarioType;
use Symfony\Component\HttpFoundation\RedirectResponse;


class GrupoUsuarioController extends Controller
{

    public function indexAction()
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

        return $this->render('BoletinesBundle:GrupoUsuario:index.html.twig', array('grupos' => $grupos,
            'css_active' => 'grupoUsuario'));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:GrupoUsuario:show.html.twig', array('grupo' => $grupoUsuario));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $grupoUsuario = $this->createEntity($request);
            if($grupoUsuario != null) {
                return $this->render('BoletinesBundle:GrupoUsuario:show.html.twig', array('grupo' => $grupoUsuario));
            } else {
                $message = "Errores";
            }
        }else{
            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($this->getUser());
        }

        return $this->render('BoletinesBundle:GrupoUsuario:new.html.twig', array('establecimientos' => $establecimientos));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoUsuarioService = $this->get('boletines.servicios.grupoUsuario');
        $usersIds = $data->request->get('idMiembro');
        if(!$usersIds){
            //por si no se agregan usuarios
            $usersIds = new ArrayCollection();
        }

        $grupoUsuario = new GrupoUsuario();
        $grupoUsuario->setNombre($data->request->get('nombre'));
        $grupoUsuario->setUsuarioCarga($this->getUser());
        $grupoUsuario->setEsPrivado(false);

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')
            ->findOneBy(array('id' => $data->request->get('establecimiento')));
        $grupoUsuario->setEstablecimiento($establecimiento);




        //TODO Facu: persistir la relación manyToMany
        foreach ($usersIds as $userId) {
            $userMiemb = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
            $grupoUsuario->addUsuario($userMiemb);
        }

        $em->persist($grupoUsuario);
        $em->flush();

        return $grupoUsuario;
    }

    public function deleteDirectorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('id' => $id));

        if ($grupoUsuario instanceof GrupoUsuario) {
//            if($this->getUser()->getInstitucion() == $alumno->getEstablecimiento()->getInstitucion()
//            && $this->getUser()->getRol()->getName == 'ROLE_DIRECTOR') {
            $em->remove($grupoUsuario);
            $em->flush();
        }
//        }
        return new RedirectResponse($this->generateUrl('directivo_grupos'));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('id' => $id));

        if($grupoUsuario instanceof GrupoUsuario) {
            $bajaAdministrativaService = $this->get('boletines.servicios.bajaAdministrativa');
            $bajaAdministrativaService->darDeBaja($grupoUsuario);
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $grupoUsuario = $this->editEntity($request, $id);
            if($grupoUsuario != null) {
                return $this->render('BoletinesBundle:GrupoUsuario:show.html.twig', array('grupo' => $grupoUsuario));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('id' => $id));
            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($this->getUser());
        }

        return $this->render('BoletinesBundle:GrupoUsuario:edit.html.twig', array('grupo' => $grupoUsuario,
            'mensaje' => $message,
            'establecimientos' => $establecimientos));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('id' => $id));
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')
            ->findOneBy(array('id' => $data->request->get('establecimiento')));
        $grupoUsuario->setEstablecimiento($establecimiento);

        $grupoUsuario->setNombre($data->request->get('nombre'));

        $em->persist($grupoUsuario);
        $em->flush();

        //TODO Facu: persistir los cambios en la lista de usuarios


        return $grupoUsuario;
    }
}

