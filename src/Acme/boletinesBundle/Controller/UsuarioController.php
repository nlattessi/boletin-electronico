<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\UsuarioType;

class UsuarioController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Usuario')->findAll();

        return $this->render('BoletinesBundle:Usuario:index.html.twig', array('entities' => $entities));
    }

    public function indexConInstitucionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Institucion')->findAll();

        return $this->render('BoletinesBundle:Usuario:index.admin.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Usuario:show.html.twig', array('usuario' => $usuario));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $usuario = $this->createEntity($request);
            if($usuario != null) {
                return $this->render('BoletinesBundle:Usuario:show.html.twig', array('usuario' => $usuario));
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();

        return $this->render('BoletinesBundle:Usuario:new.html.twig', array(
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    public function newConInstitucionAction($institucionId,Request $request ){
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $usuario = $this->createEntityConInstitucion($institucionId, $request);
            if($usuario != null) {
                return $this->editConInstitucionAction($institucionId, null);
            } else {
                $message = "Errores";
            }
        }
        return $this->render('BoletinesBundle:Usuario:new2.html.twig', array('institucionId' => $institucionId));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        if($usuario instanceof Usuario) {
            $em->remove($usuario);
            $em->flush();
        }
       // return $this->indexAction();
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $usuario->setNombre($data->request->get('nombre_apellido'));
        $usuario->setEmail($data->request->get('email'));
        $usuario->setPassword($data->request->get('password'));

        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('idRol' => $data->request->get('idRol')));

        $usuario->setRol($rol);

        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }
    private function createEntityConInstitucion($institucionId, $data)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $institucionId));
        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('nombre' => 'ROLE_DIRECTIVO'));

        $usuario = new Usuario();
        $usuario->setNombre($data->request->get('nombre_apellido'));
        $usuario->setEmail($data->request->get('email'));
        $usuario->setPassword($data->request->get('password'));

        $usuario->setInstitucion($institucion);
        $usuario->setRol($rol);

        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $entity = $this->editEntity($request, $id);
            if($entity != null) {
                return $this->getOneAction($entity->getId());
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'usuario' => $entity,
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    public function editConInstitucionAction($institucionId = null, Request $request = null){
        $message = "";
        if ($request != null && $request->getMethod() == 'POST') {

            if($request->request->has("borrar")){
                $this->deleteAction($request->request->get('id'));
            }else{
                $entity = $this->editEntity($request, $request->request->get('id'));
                if($entity == null) {
                    $message = "Errores";
                }
            }
        }

        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' =>$institucionId));

       $query = $em->createQuery('select u from BoletinesBundle:Usuario u where u.institucion = :institucionId');
        $query->setParameter('institucionId',$institucionId);
        $entities = $query->getResult();



        return $this->render('BoletinesBundle:Usuario:edit2.html.twig', array(
            'entities' => $entities,
            'mensaje' => $message,
            'institucion' => $institucion
        ));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        $usuario->setNombre($data->request->get('nombre_apellido'));
        $usuario->setEmail($data->request->get('email'));
        $usuario->setPassword($data->request->get('password'));
        $idRol = $data->request->get('idRol');

        if($idRol != null && $idRol != '') {
            $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('id' => $idRol));
            $usuario->setRol($rol);
        }
        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }


    public function new2Action()
    {
        return $this->render('BoletinesBundle:Usuario:new2.html.twig', array());
    }

    public function edit2Action()
    {
        return $this->render('BoletinesBundle:Usuario:edit2.html.twig', array());
    }
}
