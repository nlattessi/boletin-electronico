<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Docente;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\DocenteType;

class DocenteController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Docente')->findAll();

        return $this->render('BoletinesBundle:Docente:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));

        return $this->render('BoletinesBundle:Docente:show.html.twig', array('docente' => $docente));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $docente = $this->createEntity($request);
            if($docente != null) {
                return $this->render('BoletinesBundle:Docente:show.html.twig', array('docente' => $docente));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
        }

        return $this->render('BoletinesBundle:Docente:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $docente = new Docente();
        $docente->setNombreDocente($data->request->get('nombreDocente'));
        $docente->setEmailDocente($data->request->get('emailDocente'));
        $docente->setTelefonoDocente($data->request->get('telefonoDocente'));
        $idUsuario = $data->request->get('idUsuario');
        if($idUsuario == null || $idUsuario < 1){
            //no seleccionó ninguno, le creo uno
            $controllerUsuario = new UsuarioController();
            $usuario = $controllerUsuario->crearUsuarioDocente($docente->getNombreDocente(), $docente->getEmailDocente());
            $em->persist($usuario);
        }else{
            $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' =>$idUsuario ));
        }

        $docente->setUsuario($usuario);

        $em->persist($docente);
        $em->flush();

        return $docente;
    }

    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));

        if($docente instanceof Docente) {
            $em->remove($docente);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $docente = $this->editEntity($request, $id);
            if($docente != null) {
                return $this->render('BoletinesBundle:Docente:show.html.twig', array('docente' => $docente));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));
        }

        return $this->render('BoletinesBundle:Docente:edit.html.twig', array('docente' => $docente, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $docente = $em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => $id));

        $docente->setNombreDocente($data->request->get('nombreDocente'));
        $docente->setEmailDocente($data->request->get('emailDocente'));
        $docente->setTelefonoDocente($data->request->get('telefonoDocente'));
        $idUsuario = $data->request->get('idUsuario');
        if($idUsuario > 0){
            $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' =>$idUsuario ));
            $docente->setUsuario($usuario);
        }else{
            //no seleccionó ninguno
            if($docente->getUsuario() == null) {
                //no tenia ninguno
                $controllerUsuario = new UsuarioController();
                $usuario = $controllerUsuario->crearUsuarioDocente($docente->getNombreDocente(), $docente->getEmailDocente());
                $em->persist($usuario);
                $docente->setUsuario($usuario);
            }
        }


        $em->persist($docente);
        $em->flush();

        return $docente;
    }
}

