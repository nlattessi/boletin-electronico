<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Alumno;
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
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $grupos = $muchosAMuchos->obtenerGruposAlumnosPorEstablecimientos($establecimientos);

        return $this->render('BoletinesBundle:GrupoAlumno:index.html.twig', array('gruposAlumnos' => $grupos));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:GrupoAlumno:show.html.twig', array('grupo' => $grupoAlumno));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $grupoAlumno = $this->createEntity($request);
            if($grupoAlumno != null) {
                return $this->render('BoletinesBundle:GrupoAlumno:show.html.twig', array('grupo' => $grupoAlumno));
            } else {
                $message = "Errores";
            }
        }else{
            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($this->getUser());
        }

        return $this->render('BoletinesBundle:GrupoAlumno:new.html.twig', array('establecimientos' => $establecimientos));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoAlumnoService = $this->get('boletines.servicios.grupoAlumno');
        $usersIds = $data->request->get('idMiembro');
        if(!$usersIds){
            //por si no se agregan usuarios
            $usersIds = new ArrayCollection();
        }

        $grupoAlumno = new GrupoAlumno();
        $grupoAlumno->setNombre($data->request->get('nombre'));
        $grupoAlumno->setEsCurso(false);

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')
            ->findOneBy(array('id' => $data->request->get('establecimiento')));
        $grupoAlumno->setEstablecimiento($establecimiento);

        $em->persist($grupoAlumno);
        $em->flush();


        //TODO Facu: persistir la relación manyToMany
        foreach ($usersIds as $userId) {
            $userMiemb = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
            //$alumnoMiembro = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $userId));
            $alumnoMiembro = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $userMiemb->getIdEntidadAsociada()));
            if($alumnoMiembro instanceof Alumno){
                $grupoAlumnoService->nuevoAlumnoGrupoAlumno($userMiemb, $grupoAlumno);
            }
        }

        return $grupoAlumno;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('id' => $id));

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
                return $this->render('BoletinesBundle:GrupoAlumno:show.html.twig', array('grupo' => $grupoAlumno));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('id' => $id));
            $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
            $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($this->getUser());
        }

        return $this->render('BoletinesBundle:GrupoAlumno:edit.html.twig', array('grupo' => $grupoAlumno,
            'mensaje' => $message,
            'establecimientos' => $establecimientos,));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupoAlumno = $em->getRepository('BoletinesBundle:GrupoAlumno')->findOneBy(array('id' => $id));
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')
            ->findOneBy(array('id' => $data->request->get('establecimiento')));
        $grupoAlumno->setEstablecimiento($establecimiento);

        $grupoAlumno->setNombre($data->request->get('nombre'));


        $em->persist($grupoAlumno);
        $em->flush();

        //TODO Facu: persistir los cambios en la lista de alumnos

        return $grupoAlumno;
    }
}

