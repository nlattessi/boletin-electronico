<?php

namespace Acme\boletinesBundle\Controller;

//use Proxies\__CG__\Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Alumno;
use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\AlumnoType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Acme\boletinesBundle\Utils\Herramientas;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use \utilphp\util;


class AlumnoController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $alumnos = $muchosAMuchos->obtenerAlumnosPorEstablecimientos($establecimientos);

//        print_r($alumnos[0]);exit;
        return $this->render('BoletinesBundle:Alumno:index.html.twig', array('alumnos' => $alumnos,
            'establecimientos' => $establecimientos,
            'css_active' => 'alumno',));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $id));
        return $this->render('BoletinesBundle:Alumno:show.html.twig', array('alumno' => $alumno));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $alumno = $this->createEntity($request);
            if($alumno != null) {
                return $this->render('BoletinesBundle:Alumno:show.html.twig', array('alumno' => $alumno));
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $padres = $em->getRepository('BoletinesBundle:Usuario')->findAll();
        }

        return $this->render('BoletinesBundle:Alumno:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas, 'padres'=> $padres));
    }

    public function addFromDirectorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        /* Por qué el nombre así
        $usuario->setNombre(
            $request->request->get('nombre')
            . '.' .
            $request->request->get('apellido')
        );*/
        $usuario->setNombre($request->request->get('nombre'));
        $usuario->setDni($request->request->get('dni'));
        $usuario->setApellido($request->request->get('apellido'));
        $usuario->setPassword($request->request->get('dni'));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($usuario);
        $usuario->setPassword($encoder->encodePassword($usuario->getPassword(), $usuario->getSalt()));
        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('nombre' => 'ROLE_ALUMNO'));
        $usuario->setRol($rol);
        $usuario->setInstitucion($this->getUser()->getInstitucion());
        $em->persist($usuario);
        $em->flush();

        $alumno = new Alumno();
        $alumno->setNombre($request->request->get('nombre'));
        $alumno->setApellido($request->request->get('apellido'));
        $alumno->setDni($request->request->get('dni'));
        $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')
            ->findOneBy(array('id' => $request->request->get('establecimiento')));

        $alumno->setEstablecimiento($establecimiento);
        $alumno->setUsuario($usuario);

        $em->persist($alumno);

        $em->flush();

        $usuario->setIdEntidadAsociada($alumno->getId());
        $em->persist($usuario);
        $em->flush();

        return new RedirectResponse($this->generateUrl('alumno'));
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();

        $alumno = new Alumno();
        $alumno->setNombreAlumno($data->request->get('nombreAlumno'));
        $idUsuarioAlumno = $data->request->get('idUsuarioAlumno');
        if($idUsuarioAlumno > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioAlumno));
            $alumno->setUsuarioAlumno($entityRelacionada);
        }
        $idUsuarioPadre1 = $data->request->get('idUsuarioPadre1');
        if($idUsuarioPadre1 > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre1));
            $alumno->setUsuarioPadre1($entityRelacionada);
        }
        $idUsuarioPadre2 = $data->request->get('idUsuarioPadre2');
        if($idUsuarioPadre2 > 0){
            //Selecciono una UsuarioAlumno
            $entityRelacionada = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuarioPadre2));
            $alumno->setUsuarioPadre2($entityRelacionada);
        }

        $fotoFile = $data->files->get('fotoAlumno');
        if ($fotoFile) {
            $this->crearYSetearFileFoto($fotoFile, $alumno);
        }


        $em->persist($alumno);
        $em->flush();

        return $alumno;
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('idAlumno' => $id));

        if($alumno instanceof Alumno) {
            $em->remove($alumno);
            $em->flush();
        }
        return $this->indexAction();
    }

    public function deleteDirectorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $id));

        if($alumno instanceof Alumno) {
//            if($this->getUser()->getInstitucion() == $alumno->getEstablecimiento()->getInstitucion()
//            && $this->getUser()->getRol()->getName == 'ROLE_DIRECTOR') {
                $em->remove($alumno);
                $em->flush();
            }
//        }
        return new RedirectResponse($this->generateUrl('director_alumnos'));
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $this->editEntity($request, $id);
        } else if($request->get('query')){
            return $this->cargarPadre($id, $request->get('query'));
        }
        $em = $this->getDoctrine()->getManager();

       // $user = $this->getUser();
       // $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
       // $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        //$paises = $em->getRepository('BoletinesBundle:Pais')->findAll();
        $ciudades = $em->getRepository('BoletinesBundle:Ciudad')->findAll();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Alumno:edit.html.twig', array('alumno' => $alumno, 'ciudades' => $ciudades));
    }

    private function cargarPadre($idAlumno, $strBusqueda){
        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $idAlumno));

        $query = $em->createQueryBuilder()
            ->select('u.id,u.nombre, u.apellido')
            ->from('BoletinesBundle:Padre', 'u')
            ->where('LOWER(u.nombre) LIKE LOWER(:query) OR LOWER(u.apellido) LIKE LOWER(:query)')
            ->andWhere('u.establecimiento = :establecimiento')
            ->setParameter('query', '%'.$strBusqueda.'%')
            ->setParameter('establecimiento', $alumno->getEstablecimiento())
            ->getQuery();
        $entities = $query->getResult();
        $response = new JsonResponse();
        $response->setData($entities);
        return $response;
    }

    private function editEntity($request, $id)
    {
        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        /* @var $alumno Alumno*/
        $alumno = $em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $id));
        $alumno->setNombre($data['nombre']);
        $alumno->setApellido($data['apellido']);
        $alumno->setDni($data['dni']);
        //$alumno->setSexo($data['sexo']);
        $alumno->setFechaNacimiento(Herramientas::textoADatetime($data['fechaNacimiento']));
        $alumno->setFechaIngreso(Herramientas::textoADatetime($data['fechaIngreso']));
        $alumno->setDireccion($data['direccion']);
        $alumno->setCodigoPostal($data['codigoPostal']);
        $alumno->setCodigoPais($data['codigoPais']);
        $alumno->setCodigoArea($data['codigoArea']);
        $alumno->setTelefono($data['telefono']);
        $alumno->setTelefonoEmergencia($data['telefonoEmergencia']);
        $alumno->setObraSocial($data['obraSocial']);
        $alumno->setObraSocialNumeroAfiliado($data['obraSocialNumeroAfiliado']);
        $alumno->setGrupoSanguineo($data['grupoSanguineo']);
        $alumno->setApodo($data['apodo']);
        $alumno->setObservaciones($data['observaciones']);
        $alumno->getUsuario()->setEmail($data['email']);
        if (isset($data['ciudad'])) {
            $ciudad = $em->getRepository('BoletinesBundle:Ciudad')->findOneBy(array('id' => $data['ciudad']));
            $alumno->setCiudad($ciudad);
        }

        $fotoFile = $request->files->get('fotoAlumno');
        if ($fotoFile) {
            //$this->borrarFileFoto($alumno);
            $this->crearYSetearFileFoto($fotoFile, $alumno);
        }


        /*Vinculación con padre*/

        $idPadre1 = $request->request->get('padre1');

        if($idPadre1){
            $padre1 = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $idPadre1));
            if($padre1){
                $alumno->setPadre1($padre1);
            }
        }
        $idPadre2 = $request->request->get('padre2');

        if($idPadre2){
            $padre2 = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $idPadre2));
            if($padre1){
                $alumno->setPadre2($padre2);
            }
        }

        /* FIN vinculación padre*/

        $em->persist($alumno);
        $em->flush();

        return $alumno;
    }

    public function antibullyngAction($id, Request $request = null){
        //notificar Directivo
        $bullyingService = $this->get('boletines.servicios.bullying');
        $bullying = $bullyingService->create($this->getUser());

        if ($bullying != null) {
            $muchosAMuchosService = $this->get('boletines.servicios.muchosamuchos');
            $directivos = $muchosAMuchosService->obtenerDirectivosPorInstitucion($this->getUser()->getInstitucion());

            $notificacionService = $this->get('boletines.servicios.notificacion');
            $notificacionService->newBullyingNotificacion(
                $directivos,
                "Notificacion de Bullying por parte del alumno " . $this->getUser()->getEntidadAsociada()->__toString(),
                null,
                $this->generateUrl('bullying_show', ['id' => $bullying->getId()])
            );

            $this->get('session')->getFlashBag()->add('success', 'Se notificó de la situación con éxito');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Se produjo un error en la notificación...');
        }

        return $this->redirect($this->generateUrl('home'), 301);
    }

    public function autocompletarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $this->getUser()->getInstitucion();


        //TODO: mandar establecimiento por parametro y hacer la búsqueda en al tabla de Alumnos
        /*
         * $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $request->request->get('establecimiento')));
         *
         * $query = $em->createQueryBuilder()
            ->select('u.nombre', 'u.apellido', 'u.id')
            ->from('BoletinesBundle:Alumno', 'u')
            ->where('LOWER(u.nombre) LIKE LOWER(:query) OR LOWER(u.apellido) LIKE LOWER(:query)')
            ->andWhere('u.establecimiento = :establecimiento')
            ->setParameter('query', '%'.$request->query->get('query').'%')
            ->setParameter('establecimiento', $establecimiento)
            ->getQuery();
         * */

        $query = $em->createQueryBuilder()
            ->select('u.nombre', 'u.apellido', 'u.idEntidadAsociada as id')
            ->from('BoletinesBundle:Usuario', 'u')
            ->where('LOWER(u.nombre) LIKE LOWER(:query) OR LOWER(u.apellido) LIKE LOWER(:query)')
            ->andWhere('u.institucion = :institucion')
            ->andWhere('u.rol = :rolAlumnoId')
            ->setParameter('query', '%'.$request->query->get('query').'%')
            ->setParameter('institucion', $institucion)
            ->setParameter('rolAlumnoId', 3)
            ->getQuery();

        $entities = $query->getResult();

        return new Response(json_encode($entities));
    }

    private function crearYSetearFileFoto($logoFile, $alumno)
    {
        $fs = new Filesystem();
        $dir = __DIR__.'/../../../../web/bundles/boletines/uploads/portraits/alumnos/';
        $slugName = util::slugify($alumno->getNombre());
        $newFileName = rand(1, 99999) . '.' . $slugName;
        while ($fs->exists($dir . $newFileName)) {
            $newFileName = rand(1, 99999) . '.' . $slugName;
        }

        $logoFile->move(
            $dir,
            $newFileName
        );

        $alumno->setFoto($newFileName);
    }
    private function borrarFileFoto($alumno)
    {
        $fs = new Filesystem();
        if ($fs->exists($alumno->getAbsolutePath())) {
            $fs->remove($alumno->getAbsolutePath());
        }
    }
}
