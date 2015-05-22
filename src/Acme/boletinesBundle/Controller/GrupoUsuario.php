<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\GrupoUsuario;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\GrupoUsuarioType;

class GrupoUsuarioController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:GrupoUsuario')->findAll();

        return $this->render('BoletinesBundle:GrupoUsuario:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('idGrupoUsuario' => $id));

        return $this->render('BoletinesBundle:GrupoUsuario:show.html.twig', array('grupoUsuario' => $grupoUsuario));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $grupoUsuario = $this->createEntity($request);
            if($grupoUsuario != null) {
                return $this->render('BoletinesBundle:GrupoUsuario:show.html.twig', array('grupoUsuario' => $grupoUsuario));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:GrupoUsuario:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $grupoUsuario = new GrupoUsuario();
        $grupoUsuario->setNombreGrupoUsuario($data->request->get('nombreGrupoUsuario'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $grupoUsuario->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($grupoUsuario);
        $em->flush();

        return $grupoUsuario;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('idGrupoUsuario' => $id));

        if($grupoUsuario instanceof GrupoUsuario) {
            $em->remove($grupoUsuario);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $grupoUsuario = $this->editEntity($request, $id);
            if($grupoUsuario != null) {
                return $this->render('BoletinesBundle:GrupoUsuario:show.html.twig', array('grupoUsuario' => $grupoUsuario));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('idGrupoUsuario' => $id));
        }

        return $this->render('BoletinesBundle:GrupoUsuario:edit.html.twig', array('grupoUsuario' => $grupoUsuario, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoUsuario = $em->getRepository('BoletinesBundle:GrupoUsuario')->findOneBy(array('idGrupoUsuario' => $id));

        $grupoUsuario->setNombreGrupoUsuario($data->request->get('nombreGrupoUsuario'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $grupoUsuario->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($grupoUsuario);
        $em->flush();

        return $grupoUsuario;
    }
}

