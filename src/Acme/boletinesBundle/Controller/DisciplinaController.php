<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Disciplina;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\DisciplinaType;

class DisciplinaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Disciplina')->findAll();

        return $this->render('BoletinesBundle:Disciplina:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));

        return $this->render('BoletinesBundle:Disciplina:show.html.twig', array('disciplina' => $disciplina));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $disciplina = $this->createEntity($request);
            if($disciplina != null) {
                return $this->render('BoletinesBundle:Disciplina:show.html.twig', array('disciplina' => $disciplina));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
        }

        return $this->render('BoletinesBundle:Disciplina:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $disciplina = new Disciplina();
        $disciplina->setNombreDisciplina($data->request->get('nombreDisciplina'));
        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada > 1){
            //Selecciono una EntityRelacionada
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $disciplina->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($disciplina);
        $em->flush();

        return $disciplina;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));

        if($disciplina instanceof Disciplina) {
            $em->remove($disciplina);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $disciplina = $this->editEntity($request, $id);
            if($disciplina != null) {
                return $this->render('BoletinesBundle:Disciplina:show.html.twig', array('disciplina' => $disciplina));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:EntityRelacionada')->findAll();
            $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));
        }

        return $this->render('BoletinesBundle:Disciplina:edit.html.twig', array('disciplina' => $disciplina, 'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $disciplina = $em->getRepository('BoletinesBundle:Disciplina')->findOneBy(array('idDisciplina' => $id));

        $disciplina->setNombreDisciplina($data->request->get('nombreDisciplina'));

        $idEntityRelacionada = $data->request->get('idEntityRelacionada');
        if($idEntityRelacionada != null || $idEntityRelacionada > 1){
            //Selecciono otra EntityRelacionada, hay que buscarla y persistirla
            $entityRelacionada = $em->getRepository('BoletinesBundle:EntityRelacionada')->findOneBy(array('idEntityRelacionada' => $idEntityRelacionada));
            $disciplina->setEntityRelacionada($entityRelacionada);
        }

        $em->persist($disciplina);
        $em->flush();

        return $disciplina;
    }
}

