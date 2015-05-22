<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\GrupoAlumno;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\GrupoAlumnoType;

class GrupoAlumnoController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:GrupoAlumno')->findAll();

        return $this->render('BoletinesBundle:GrupoAlumno:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('idGrupoAlumno' => $id));

        return $this->render('BoletinesBundle:GrupoAlumno:show.html.twig', array('grupoAlumno' => $grupoAlumno));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $grupoAlumno = $this->createEntity($request);
            if($grupoAlumno != null) {
                return $this->render('BoletinesBundle:GrupoAlumno:show.html.twig', array('grupoAlumno' => $grupoAlumno));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:GrupoAlumno:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $grupoAlumno = new GrupoAlumno();
        $grupoAlumno->setNombreGrupoAlumno($data->request->get('nombreGrupoAlumno'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 0){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $grupoAlumno->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($grupoAlumno);
        $em->flush();

        return $grupoAlumno;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('idGrupoAlumno' => $id));

        if($grupoAlumno instanceof GrupoAlumno) {
            $em->remove($grupoAlumno);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $grupoAlumno = $this->editEntity($request, $id);
            if($grupoAlumno != null) {
                return $this->render('BoletinesBundle:GrupoAlumno:show.html.twig', array('grupoAlumno' => $grupoAlumno));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('idGrupoAlumno' => $id));
        }

        return $this->render('BoletinesBundle:GrupoAlumno:edit.html.twig', array('grupoAlumno' => $grupoAlumno, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('idGrupoAlumno' => $id));

        $grupoAlumno->setNombreGrupoAlumno($data->request->get('nombreGrupoAlumno'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada != null || $idEntityRelacionada > 0){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $grupoAlumno->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($grupoAlumno);
        $em->flush();

        return $grupoAlumno;
    }
}

