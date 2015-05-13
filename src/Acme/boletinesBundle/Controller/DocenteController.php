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

        return $this->render('BoletinesBundle:Docente:show.html.twig', array('entity' => $docente));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $docente = $this->createEntity($request);
            if($docente != null) {
                return $this->render('BoletinesBundle:Docente:show.html.twig', array('entity' => $docente));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
        }

        return $this->render('BoletinesBundle:Docente:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
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
    private function crearUsuarioDocente($nombreReal, $email){
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $usuario->setNombreReal($nombreReal);
        $usuario->setPassword('12345');
        $usuario->setNombreUsuario($email);
        $usuario->setNombreUsuarioParaMostrar($nombreReal);

        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $docente = $em->getRepository('BoletinesBundle:Docente')->find($id);

        if (!$docente) {
            throw $this->createNotFoundException('Unable to find Docente entity.');
        }

        $editForm = $this->createEditForm($docente);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'entity'      => $docente,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}

