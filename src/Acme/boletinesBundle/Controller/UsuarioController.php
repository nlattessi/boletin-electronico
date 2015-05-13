<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Entidad;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\EntidadType;

class UsuarioController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Entidad')->findAll();

        return $this->render('BoletinesBundle:Entidad:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entidad = $em->getRepository('BoletinesBundle:Entidad')->findOneBy(array('idEntidad' => $id));

        return $this->render('BoletinesBundle:Entidad:show.html.twig', array('entity' => $entidad));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $entidad = $this->createEntity($request);
            if($entidad != null) {
                return $this->render('BoletinesBundle:Entidad:show.html.twig', array('entity' => $entidad));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Entidad:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('BoletinesBundle:Entidad')->findOneBy(array('idEntidad' => $id));

        if($entidad instanceof Entidad) {
            $em->remove($entidad);
            $em->flush();
        }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $entidad = new Entidad();
        $entidad->setNombreEntidad($data->request->get('nombreEntidad'));
        $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $data->request->get('idEntityRelacionada')));
        $entidad->setIdEntityRelacionada($entityRelacionada);

        $em->persist($entidad);
        $em->flush();

        return $entidad;
    }
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entidad = $em->getRepository('BoletinesBundle:Entidad')->find($id);

        if (!$entidad) {
            throw $this->createNotFoundException('Unable to find Entidad entity.');
        }

        $editForm = $this->createEditForm($entidad);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'entity'      => $entidad,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function crearUsuarioDocente($nombreReal, $email){
       // $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $usuario->setNombreReal($nombreReal);
        $usuario->setPassword('12345');
        $usuario->setNombreUsuario($email);
        $usuario->setNombreUsuarioParaMostrar($nombreReal);

       // $em->persist($usuario);
       // $em->flush();

        return $usuario;
    }

}

