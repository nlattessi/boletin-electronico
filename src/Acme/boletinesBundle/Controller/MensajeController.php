<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Acme\boletinesBundle\Entity\Usuario;


class MensajeController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');

        $mensajes = $mensajeService->getMensajes($usuario);

        $mensajesNotLeidos = $mensajeService->getMensajesNotLeidos($usuario);

        $mensajesEnviados = $mensajeService->getMensajesEnviados($usuario);

        $mensajesBorrados = $mensajeService->getMensajesBorrados($usuario);

        return $this->render('BoletinesBundle:Mensaje:index.html.twig', array(
            'mensajes' => $mensajes,
            'mensajesNotLeidos' => $mensajesNotLeidos,
            'mensajesEnviados' => $mensajesEnviados,
            'mensajesBorrados' => $mensajesBorrados
        ));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');

        $mensajeUsuario = $mensajeService->readMensaje($usuario, $id);

        return $this->render('BoletinesBundle:Mensaje:show.html.twig', array('mensaje' => $mensajeUsuario));
    }

    public function newAction(Request $request)
    {
        $message = "";

        if ($request->getMethod() == 'POST') {
            $mensaje = $this->createEntity($request);

            if ($mensaje != null ) {
                return $this->redirect($this->generateUrl('mensaje'), 301);
            } else {
                $message = "Errores";
            }
        }

        return $this->render('BoletinesBundle:Mensaje:new.html.twig', array());
    }


    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        if($usuario instanceof Usuario){
          $mensajeService =  $this->get('boletines.servicios.mensaje');

          $mensaje = $mensajeService->newMensaje(
              $usuario,
              $data->request->get('tituloMensaje'),
              $data->request->get('textoMensaje')
          );

          $usersIds = $data->request->get('idUsuarioRecibe');

          foreach ($usersIds as $userId) {
              $userRecibe = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
              if($userRecibe instanceof Usuario){
                  $mensajeService->newMensajeUsuario($userRecibe, $mensaje);
              }
          }
        } else {
            return $this->redirect($this->generateUrl('login'), 301);
        }

        return true;
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');
        $mensajeUsuario = $mensajeService->deleteMensaje($usuario, $id);

        return $this->redirect($this->generateUrl('mensaje'), 301);
    }

    public function deleteCheckedMensajesAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
          $em = $this->getDoctrine()->getManager();
          $usuario = $usuario = $this->getUser();

          $mensajesIds = $request->request->get('idMensajeBorrar');

          if (! empty($mensajesIds)) {
              $mensajeService =  $this->get('boletines.servicios.mensaje');
              $mensajeService->deleteMensajesUsuario($mensajesIds);
          }
        }

        return $this->redirect($this->generateUrl('mensaje'), 301);
    }

    public function autocompletarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $this->getUser()->getInstitucion();

        $query = $em->createQueryBuilder()
            ->select('u.nombre', 'u.apellido', 'u.id')
            ->from('BoletinesBundle:Usuario', 'u')
            ->where('LOWER(u.nombre) LIKE LOWER(:query) OR LOWER(u.apellido) LIKE LOWER(:query)')
            ->andWhere('u.institucion = :institucion')
            ->setParameter('query', '%'.$request->query->get('query').'%')
            ->setParameter('institucion', $institucion)
            ->getQuery();

        $entities = $query->getResult();

        return new Response(json_encode($entities));
    }
}
