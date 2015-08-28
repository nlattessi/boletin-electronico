<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Institucion;
use Acme\boletinesBundle\Entity\Establecimiento;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use \utilphp\util;

class InstitucionController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Institucion')->findAll();

        return $this->render('BoletinesBundle:Institucion:index.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $id));

        $establecimientos = $em->getRepository('BoletinesBundle:Establecimiento')->findBy(array('institucion' => $institucion));
        $establecimientosCount = count($establecimientos);

        return $this->render('BoletinesBundle:Institucion:show.html.twig', array('institucion' => $institucion, 'establecimientosCount' => $establecimientosCount));
    }

    public function getalumnosAction($id)
    {
        $alumnos = array();
        $em = $this->getDoctrine()->getManager();

        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $id));
        $establecimientos = $em->getRepository('BoletinesBundle:Establecimiento')->findBy(array('institucion' => $institucion));

        foreach ($establecimientos as $establecimiento) {
            $alumnosAux =  $em->getRepository('BoletinesBundle:Alumno')->findBy(array('establecimientoId' => $establecimiento));
            foreach ($alumnosAux as $alumno) {
                $alumnos[] = $alumno;
            }
        }

        return $this->render('BoletinesBundle:Institucion:alumnos.html.twig', array('alumnos' => $alumnos));
    }

    public function newAction(Request $request)
    {
        $error = "";

        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $institucion = $this->createEntity($request);
            if($institucion != null)
            {
                $creacionService =  $this->get('boletines.servicios.creacion');
                $establecimiento = $creacionService->crearEstablecimiento($request, $institucion);

                if ($request->request->has("finalizar")){
                    return new RedirectResponse($this->generateUrl('institucion_show', array('id' => $institucion->getId())));
                } else{
                    return new RedirectResponse($this->generateUrl('establecimiento_new_with_institucion', array('institucionId' => $institucion->getId())));
                }
            } else {
                $error = "Errores alta institucion";
            }
        }

        return $this->render('BoletinesBundle:Institucion:new.html.twig', array('error' => $error));
    }

    private function createEntity($data)
    {
        $institucion = new Institucion();
        $institucion->setNombre($data->request->get('nombreInstitucion'));
        $institucion->setCuit($data->request->get('cuit'));

        $logoFile = $data->files->get('logoInstitucion');
        if ($logoFile) {
            $this->crearYSetearFileLogo($logoFile, $institucion);
        }

        $validator = $this->get('validator');
        $errors = $validator->validate($institucion);
        if (count($errors) > 0) {
            return false;
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($institucion);
        $em->flush();

        return $institucion;
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $id));

       if($institucion instanceof Institucion) {
           $em->remove($institucion);
           $em->flush();
           $this->borrarFileLogo($institucion);
       }
        //return $this->indexAction();
       return new RedirectResponse($this->generateUrl('institucion'));
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $institucion = $this->editEntity($request, $id);
            if($institucion != null) {
                //return $this->render('BoletinesBundle:Institucion:show.html.twig', array('institucion' => $institucion));
                return new RedirectResponse($this->generateUrl('institucion_show', array('id' => $institucion->getId())));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $id));
        }

        return $this->render('BoletinesBundle:Institucion:edit.html.twig', array('institucion' => $institucion, 'mensaje' => $message));
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if (!($request->getMethod() == 'POST' && $request->request->get('search'))) {
            return new RedirectResponse($this->generateUrl('institucion'));
        }
        $repo = $em->getRepository('BoletinesBundle:Institucion');
        $query = $repo->createQueryBuilder('inst')
            ->where('inst.nombre LIKE :search')
            ->setParameter('search', '%'.$request->request->get('search').'%')
            ->getQuery();

        $entities = $query->getResult();

        return $this->render('BoletinesBundle:Institucion:index.html.twig', array('entities' => $entities));
    }

    private function editEntity($data, $id)
    {
        try{
            $em = $this->getDoctrine()->getManager();

            $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $id));

            $institucion->setNombre($data->request->get('nombreInstitucion'));
            $institucion->setCuit($data->request->get('cuit'));

            $logoFile = $data->files->get('logoInstitucion');
            if ($logoFile) {
                $this->borrarFileLogo($institucion);
                $this->crearYSetearFileLogo($logoFile, $institucion);
            }

            $em->persist($institucion);
            $em->flush();

        } catch (\Exception $e) {
            $error = $e->getMessage();
            // si quieren ver el error hacen un print de esto y exit : print_r( $error ); exit();
            return false;
        }

        return $institucion;
    }

    private function crearYSetearFileLogo($logoFile, $institucion)
    {
        $fs = new Filesystem();
        $dir = __DIR__.'/../../../../web/uploads/logos/';
        $slugName = util::slugify($institucion->getNombre());
        $newFileName = rand(1, 99999) . '.' . $slugName;
        while ($fs->exists($dir . $newFileName)) {
            $newFileName = rand(1, 99999) . '.' . $slugName;
        }

        $logoFile->move(
            $dir,
            $newFileName
        );

        $institucion->setLogo($newFileName);
    }

    private function borrarFileLogo($institucion)
    {
        $fs = new Filesystem();
        if ($fs->exists($institucion->getAbsolutePath())) {
            $fs->remove($institucion->getAbsolutePath());
        }
    }
}
