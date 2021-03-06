<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Establecimiento;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\EstablecimientoType;
use Acme\boletinesBundle\Entity\Especialidad;

class EstablecimientoController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Establecimiento')->findAll();

        return $this->render('BoletinesBundle:Establecimiento:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Establecimiento:show.html.twig', array('establecimiento' => $establecimiento,
            'css_active' => 'institucion',));
    }

    public function newWithInstitucionAction($institucionId, Request $request)
    {
        $error = "";

        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca

            $em = $this->getDoctrine()->getManager();
            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $institucionId));

            $creacionService =  $this->get('boletines.servicios.creacion');
            $establecimiento = $creacionService->crearEstablecimiento($request, $institucion);

            if ($establecimiento != null) {

                if ($request->request->has("crear")){
                    return new RedirectResponse($this->generateUrl('institucion_show', array('id' => $institucion->getId())));
                } else{
                    return new RedirectResponse($this->generateUrl('establecimiento_new_with_institucion',
                        array('institucion' => $institucion,
                            'institucionId' => $institucion->getId(),
                            'css_active' => 'institucion',)));
                }

            } else {
                $error = "Errores";
            }

        } else {
            $em = $this->getDoctrine()->getManager();
            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $institucionId));
        }
        $queryBuilder= $entities = $em->getRepository('BoletinesBundle:EsquemaCalificacion')->createQueryBuilder('e')
            ->where('e.id > 1');
        $esquemas = $queryBuilder->getQuery()->getResult();
        //$paises = $em->getRepository('BoletinesBundle:Pais')->findAll();
        $ciudades = $em->getRepository('BoletinesBundle:Ciudad')->findAll();

        return $this->render('BoletinesBundle:Establecimiento:new.html.twig', array('institucion' => $institucion,
            'error' => $error,
            'esquemas' => $esquemas,
            'ciudades' => $ciudades,
            'css_active' => 'institucion',));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));

        $institucion = $establecimiento->getInstitucion();

        if ($establecimiento instanceof Establecimiento) {
            $bajaAdministrativaService = $this->get('boletines.servicios.bajaAdministrativa');
            $bajaAdministrativaService->darDeBaja($establecimiento);
            /*$em->remove($establecimiento);
            $em->flush();*/
        }

        return new RedirectResponse($this->generateUrl('institucion_show', array('id' => $institucion->getId())));
    }

    public function editAction($id = null, Request $request = null)
    {
        $error = "";

        if ($request->getMethod() == 'POST') {
            $creacionService =  $this->get('boletines.servicios.creacion');
            $establecimiento = $creacionService->editarEstablecimiento($request, $id);

            if ($establecimiento != null) {
                return new RedirectResponse($this->generateUrl('establecimiento_show', array('id' => $establecimiento->getId(),
                    'css_active' => 'institucion',)));
            } else {
                $error = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));
        }
        $queryBuilder= $entities = $em->getRepository('BoletinesBundle:EsquemaCalificacion')->createQueryBuilder('e')
            ->where('e.id > 1');
        $esquemas = $queryBuilder->getQuery()->getResult();
        //$paises = $em->getRepository('BoletinesBundle:Pais')->findAll();
        $ciudades = $em->getRepository('BoletinesBundle:Ciudad')->findAll();

        return $this->render('BoletinesBundle:Establecimiento:edit.html.twig', array('establecimiento' => $establecimiento,
            'error' => $error,
            'esquemas' => $esquemas,
            'ciudades' => $ciudades,
            'css_active' => 'institucion',));
    }

    public function  editDirecotorAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository('BoletinesBundle:UsuarioEstablecimiento')->findOneBy(array('usuario' => $user));

        return new RedirectResponse($this->generateUrl('establecimiento_edit', array('id' => $establecimiento->getEstablecimiento()->getId())));
    }




    public function addEspecialidadAction($id, Request $request)
    {
        $error = "";

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));

            $especialidad = $this->crearEspecialidad($establecimiento, $request);

            if ($especialidad != null) {
                return new RedirectResponse($this->generateUrl('establecimiento_show_especialidades', array('id' => $establecimiento->getId())));
            } else {
                $error = "Errores";
            }

        } else {
            $em = $this->getDoctrine()->getManager();
            $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));
        }

        return $this->render('BoletinesBundle:Establecimiento:add_especialidad.html.twig', array('establecimiento' => $establecimiento, 'error' => $error));
    }

    private function crearEspecialidad($establecimiento, $data)
    {
        $em = $this->getDoctrine()->getManager();

        $especialidad = new Especialidad();

        $especialidad->setNombre($data->request->get('nombre'));
        $especialidad->setDescripcion($data->request->get('descripcion'));
        $especialidad->setEstablecimiento($establecimiento);

        $em->persist($especialidad);
        $em->flush();

        return $especialidad;
    }

    public function removeEspecialidadAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $especialidad = $em->getRepository('BoletinesBundle:Especialidad')->findOneBy(array('id' => $id));

        if ($especialidad instanceof Especialidad) {
            $em->remove($especialidad);
            $em->flush();
        }

        return new RedirectResponse($this->generateUrl('establecimiento_show_especialidades', array('id' => $especialidad->getEstablecimiento()->getId())));
    }

    public function showEspecialidadesAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));
        $especialidades = $em->getRepository('BoletinesBundle:Especialidad')->findBy(array('establecimiento' => $establecimiento));

        return $this->render('BoletinesBundle:Establecimiento:show_especialidades.html.twig', array(
            'establecimiento' => $establecimiento,
            'especialidades' => $especialidades
        ));
    }
}
