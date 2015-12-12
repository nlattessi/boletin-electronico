<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Alumno;
use Acme\boletinesBundle\Utils\Herramientas;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\boletinesBundle\Servicios\SesionService;
use Acme\boletinesBundle\Entity\Convivencia;


class ConvivenciaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()->getRol()->getNombre() == 'ROLE_PADRE' ||
            $this->getUser()->getRol()->getNombre() == 'ROLE_ALUMNO'){
            $request = $this->getRequest();
            $session = $request->getSession();
            $alumno = $session->get('alumnoActivo');
            if($alumno){
                $convivenciaService =  $this->get('boletines.servicios.convivencia');
                $entities = $convivenciaService->obtenerConvivenciaAlumno($alumno->getId());
                return $this->render('BoletinesBundle:Convivencia:index.html.twig', array('entities' => $entities,
                    'css_active' => 'convivencia',));
            }else{
                return $this->render('BoletinesBundle:Asistencia:index.html.twig', array('entities' => null,
                    'mensaje' => "Usted no tiene hijos asociados, consulte con el administrador",
                    'css_active' => 'convivencia',));
            }
        }
        else if($this->getUser()->getRol()->getNombre() == 'ROLE_DOCENTE')
        {
            $convivenciaService =  $this->get('boletines.servicios.convivencia');
            $entities = $convivenciaService->obtenerConvivenciaPorUsuario($this->getUser()->getId());
            return $this->render('BoletinesBundle:Convivencia:index.html.twig', array('entities' => $entities,
                'css_active' => 'convivencia',));
        }
        else{
            $entities = $em->getRepository('BoletinesBundle:Convivencia')->findAll();
        }


        return $this->render('BoletinesBundle:Convivencia:index.html.twig', array('entities' => $entities,
            'css_active' => 'convivencia',));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Convivencia:show.html.twig', array('convivencia' => $convivencia));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $convivencia = $this->createEntity($request);
            if($convivencia != null) {
                return $this->render('BoletinesBundle:Convivencia:show.html.twig', array('convivencia' => $convivencia,
                    'css_active' => 'convivencia',));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Alumno')->findAll();
        }

        return $this->render('BoletinesBundle:Convivencia:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas,
            'css_active' => 'convivencia',));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        $usersIds = $data->request->get('idMiembro');

        if(!$usersIds){
            //por si no se agregan usuarios
            $usersIds = new ArrayCollection();
        }

        $convivencia = null;
        foreach ($usersIds as $userId) {
            $userMiemb = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
            //$alumnoMiembro = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $userId));
            $alumno= $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $userMiemb->getIdEntidadAsociada()));

            if($alumno instanceof Alumno){
                $convivencia = new Convivencia();
                $convivencia->setComentario($data->request->get('comentario'));
                $convivencia->setUsuarioCarga($usuario);
                $convivencia->setFechaCreacion(new \DateTime('now'));
                $convivencia->setValidado(false);
                $fecha = $data->request->get('fechaSuceso');
                $fecha = Herramientas::textoADatetime($fecha);
                $convivencia->setFechaSuceso($fecha);
                $valor = $data->request->get('valor');
                if($valor){
                    $convivencia->setValor(true);
                }else{
                    $convivencia->setValor(false);
                }
                $convivencia->setAlumno($alumno);
                $em->persist($convivencia);

            }
        }

        $em->flush();
        return $convivencia;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('id' => $id));

        if($convivencia instanceof Convivencia) {
            $em->remove($convivencia);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $convivencia = $this->editEntity($request, $id);
            if($convivencia != null) {
                return $this->render('BoletinesBundle:Convivencia:show.html.twig', array('convivencia' => $convivencia,
                    'css_active' => 'convivencia',));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Alumno')->findAll();
            $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('id' => $id));
        }

        return $this->render('BoletinesBundle:Convivencia:edit.html.twig', array('convivencia' => $convivencia,
            'mensaje' => $message,'entitiesRelacionadas' => $entitiesRelacionadas,
            'css_active' => 'convivencia',));
    }
    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        $convivencia = $em->getRepository('BoletinesBundle:Convivencia')->findOneBy(array('id' => $id));

        if($usuario->getRol()->getNombre() == "ROLE_ALUMNO") {
            $convivencia->setDescargo($data->request->get('descargo'));
        }else{
            //Director, Bedel o Docente, lo mismo da
            $convivencia->setComentario($data->request->get('comentario'));
            $convivencia->setUsuarioCarga($usuario);
            $convivencia->setFechaActualizacion(new \DateTime('now'));
            $fecha = $data->request->get('fechaSuceso');
            $fecha = Herramientas::textoADatetime($fecha);
            $convivencia->setFechaSuceso($fecha);
            $valor = $data->request->get('valor');
            if($valor){
                $convivencia->setValor(true);
            }else{
                $convivencia->setValor(false);
            }

        }

        $em->persist($convivencia);
        $em->flush();

        return $convivencia;
    }
}

