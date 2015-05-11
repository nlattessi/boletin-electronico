<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Materia;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\MateriaType;

class MateriaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Materia')->findAll();

        return $this->render('BoletinesBundle:Materia:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entidad = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $id));

        return $this->render('BoletinesBundle:Materia:show.html.twig', array('entity' => $entidad));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $entidad = $this->createEntity($request);
            if($entidad != null) {
                return $this->render('BoletinesBundle:Materia:show.html.twig', array('entity' => $entidad));
            } else {
                $message = "Errores";
            }
        }

        return $this->render('BoletinesBundle:Materia:new.html.twig', array('mensaje' => $message));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('BoletinesBundle:Materia')->findOneBy(array('idMateria' => $id));

       if($entidad instanceof Materia) {
           $em->remove($entidad);
           $em->flush();
       }
        return $this->indexAction();
    }

    private function createEntity($data)
    {
    	$em = $this->getDoctrine()->getManager();
			
    	$tipoMateria = $em->getRepository('BoletinesBundle:TipoMateria')->findOneBy(array('idTipoMateria' => $data->request->get('idTipoMateria')));
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => 1));
		$calendario = new Calendario();
		$calendario ->setIdUsuarioPropietario($usuario);
		$calendario ->setNombreCalendario("Calendario de " . $data->request->get('nombreMateria'));
		$em->persist($calendario);
        $em->flush();
        $entidad = new Materia();
        $entidad->setNombreMateria($data->request->get('nombreMateria'));
    //    $materia->setIdTipoMateria($data->request->get('idTipoMateria'));
        $entidad->setIdTipoMateria($tipoMateria);
        $entidad->setIdCalendarioMateria($calendario);

   
        $em->persist($entidad);
        $em->flush();

        return $entidad;
    }
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entidad = $em->getRepository('BoletinesBundle:Materia')->find($id);

        if (!$entidad) {
            throw $this->createNotFoundException('Unable to find Materia entity.');
        }

        $editForm = $this->createEditForm($entidad);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'entity'      => $entidad,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
