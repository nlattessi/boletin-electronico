<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\MensajeUsuario;
use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Mensaje;
use Acme\boletinesBundle\Entity\Calendario;
use Symfony\Component\HttpFoundation\Response;
use Acme\boletinesBundle\Form\MensajeType;

class MensajeController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $usuario = $this->getUser();
        $mensajesUsuario = $em->getRepository('BoletinesBundle:MensajeUsuario')->findBy(array('usuario' => $usuario, 'borrado' => false));

        $mensajes = array();
        foreach ($mensajesUsuario as $mensajeUsuario) {
            $mensajes[] = $mensajeUsuario->getMensaje();
        }

        return $this->render('BoletinesBundle:Mensaje:index.html.twig', array('entities' => $mensajes));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $usuario = $this->getUser();
        $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('id' => $id));
        $mensajeUsuario = $em->getRepository('BoletinesBundle:MensajeUsuario')->findOneBy(array('mensaje' => $mensaje, 'usuario' => $usuario, 'borrado' => false));
        if($mensajeUsuario instanceof MensajeUsuario) {
            $mensajeUsuario->setLeido(true);
            $em->persist($mensajeUsuario);
            $em->flush();
            $mensaje = $mensajeUsuario->getMensaje();
        }
        return $this->render('BoletinesBundle:Mensaje:show.html.twig', array('mensaje' => $mensaje));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $mensaje = $this->createEntity($request);
            if($mensaje != null) {
                return $this->indexAction();
            } else {
                $message = "Errores";
            }
        }else{
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
        }

        return $this->render('BoletinesBundle:Mensaje:new.html.twig', array('entitiesRelacionadas' => $entitiesRelacionadas));
    }
    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        if($usuario instanceof Usuario){
            $usersIds = $data->request->get('idUsuarioRecibe');
            $date = new \DateTime('now');

            foreach ($usersIds as $userId) {
                $userRecibe = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
                if($userRecibe instanceof Usuario){
                    $mensaje = new Mensaje();
                    $mensaje->setTitulo($data->request->get('tituloMensaje'));
                    $mensaje->setTexto($data->request->get('textoMensaje'));
                    $mensaje->setFechaEnvio($date);
                    $mensaje->setUsuario($usuario);

                    $em->persist($mensaje);
                    $em->flush();

                    $mensajeUsuario = new MensajeUsuario();
                    $mensajeUsuario->setBorrado(false);
                    $mensajeUsuario->setLeido(false);
                    $mensajeUsuario->setMensaje($mensaje);
                    $mensajeUsuario->setCreationTime($date);
                    $mensajeUsuario->setUpdateTime($date);
                    $mensajeUsuario->setUsuario($userRecibe);

                    $em->persist($mensajeUsuario);
                    $em->flush();
                }
            }
        } else {
            //Todo Go TO LOGIN
            exit();
        }

        return true;
    }


    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $usuario = $this->getUser();
        $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('id' => $id, 'usuario' => $usuario));

        if($mensaje instanceof Mensaje) {
            $mensajeUsuario = $em->getRepository('BoletinesBundle:MensajeUsuario')->findOneBy(array('mensaje' => $mensaje));
            $mensajeUsuario->setBorrado(true);
            $em->persist($mensajeUsuario);
            $em->flush();
        }
        return $this->indexAction();
    }


    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $mensaje = $this->editEntity($request, $id);
            if($mensaje != null) {
                return $this->render('BoletinesBundle:Mensaje:show.html.twig', array('mensaje' => $mensaje));
            } else {
                $message = "Errores";
            }
        } else {
            $em = $this->getDoctrine()->getManager();
            $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Usuario')->findAll();
            $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('id' => $id));
        }

        return $this->render('BoletinesBundle:Mensaje:edit.html.twig', array('mensaje' => $mensaje,'entitiesRelacionadas' => $entitiesRelacionadas));
    }

    public function autocompletarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $this->getUser()->getInstitucion();


        $query = $em->createQueryBuilder()
            ->select('u.nombre', 'u.apellido', 'u.id')
            ->from('BoletinesBundle:Usuario', 'u')
            ->where('upper(u.nombre) LIKE :query OR upper(u.apellido) LIKE upper(:query)')
            ->andWhere('u.institucion = :institucion')
            ->setParameter('query', '%'.$request->query->get('query').'%')
            ->setParameter('institucion', $institucion)
            ->getQuery();

        $entities = $query->getResult();

        return new Response(json_encode($entities));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sesionService = $this->get('boletines.servicios.sesion');

        $mensaje = $em->getRepository('BoletinesBundle:Mensaje')->findOneBy(array('id' => $id));

        $mensaje->setTituloMensaje($data->request->get('tituloMensaje'));
        $mensaje->setTextoMensaje($data->request->get('textoMensaje'));
        $mensaje->setUsuarioEnvia($sesionService->obtenerUsuario());
        $mensaje->setFechaEnvio(new \DateTime('now'));
        $mensaje->setBorrado(false);

        $idUsuario = $data->request->get('idUsuarioRecibe');
        if($idUsuario > 0){
            //Selecciono otra Usuario, hay que buscarla y persistirla
            $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $idUsuario));
            $mensaje->setUsuarioRecibe($usuario);
        }

        $em->persist($mensaje);
        $em->flush();

        return $mensaje;
    }
}

