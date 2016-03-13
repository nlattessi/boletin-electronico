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
        $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');

        $mensajes = $mensajeService->getMensajesUsuario($usuario);

        $mensajesNotLeidos = $mensajeService->getMensajesUsuarioNotLeidos($usuario);

        $mensajesEnviados = $mensajeService->getMensajesEnviados($usuario);

        $mensajesBorradores = $mensajeService->getMensajesBorradores($usuario);

        $mensajesBorrados = $mensajeService->getMensajesUsuarioBorrados($usuario);

        return $this->render('BoletinesBundle:Mensaje:index.html.twig', array(
            'mensajes' => $mensajes,
            'mensajesNotLeidos' => $mensajesNotLeidos,
            'mensajesEnviados' => $mensajesEnviados,
            'mensajesBorradores' => $mensajesBorradores,
            'mensajesBorrados' => $mensajesBorrados
        ));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');

        $mensaje = $mensajeService->readMensaje($usuario, $id);

        $mensajeAnterior = $mensajeService->getAnteriorOSiguienteMensaje(
            $usuario, $mensaje,
            $mensajeService::RECIBIDO, $mensajeService::ANTERIOR
        );

        $mensajeSiguiente = $mensajeService->getAnteriorOSiguienteMensaje(
            $usuario, $mensaje,
            $mensajeService::RECIBIDO, $mensajeService::SIGUIENTE
        );

        return $this->render('BoletinesBundle:Mensaje:show.html.twig', array(
          'mensaje' => $mensaje,
          'mensaje_anterior' => $mensajeAnterior,
          'mensaje_siguiente' => $mensajeSiguiente,
          'es_borrable' => true
        ));
    }

    public function getOneEnviadoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');

        $mensajeEnviado = $mensajeService->getMensajeById($id);

        $mensajeAnterior = $mensajeService->getAnteriorOSiguienteMensaje(
            $usuario, $mensajeEnviado,
            $mensajeService::ENVIADO, $mensajeService::ANTERIOR
        );

        $mensajeSiguiente = $mensajeService->getAnteriorOSiguienteMensaje(
            $usuario, $mensajeEnviado,
            $mensajeService::ENVIADO, $mensajeService::SIGUIENTE
        );

        return $this->render('BoletinesBundle:Mensaje:show.html.twig', array(
          'mensaje' => $mensajeEnviado,
          'mensaje_enviado_anterior' => $mensajeAnterior,
          'mensaje_enviado_siguiente' => $mensajeSiguiente
        ));
    }

    public function getOneBorradoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');

        $mensajeBorrado = $mensajeService->getMensajeById($id);

        $mensajeAnterior = $mensajeService->getAnteriorOSiguienteMensaje(
            $usuario, $mensajeBorrado,
            $mensajeService::BORRADO, $mensajeService::ANTERIOR
        );

        $mensajeSiguiente = $mensajeService->getAnteriorOSiguienteMensaje(
            $usuario, $mensajeBorrado,
            $mensajeService::BORRADO, $mensajeService::SIGUIENTE
        );

        return $this->render('BoletinesBundle:Mensaje:show.html.twig', array(
          'mensaje' => $mensajeBorrado,
          'mensaje_borrado_anterior' => $mensajeAnterior,
          'mensaje_borrado_siguiente' => $mensajeSiguiente
        ));
    }

    public function getOneBorradorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $mensajeService = $this->get('boletines.servicios.mensaje');

        $mensajeBorrador = $mensajeService->getMensajeById($id);

        $destinatarios = $mensajeService->getDestinatariosFromBorrador($mensajeBorrador);

        return $this->render('BoletinesBundle:Mensaje:new.html.twig', array(
            'mensajeBorrador' => $mensajeBorrador,
            'destinatarios' => $destinatarios
        ));
    }

    public function newAction(Request $request)
    {
        $message = "";

        if ($request->getMethod() == 'POST') {
            $mensaje = $this->createEntity($request);

            if ($mensaje != null ) {
                $this->get('session')->getFlashBag()->add('success', 'Enviado con éxito');
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

          if ($data->request->get('idMensajeBorrador')) {
              $mensaje = $mensajeService->getMensajeBorradorParaEnviar(
                  $usuario,
                  $data->request->get('tituloMensaje'),
                  $data->request->get('textoMensaje'),
                  $data->request->get('idMensajeBorrador')
              );
          } else {
              $mensaje = $mensajeService->newMensaje(
                  $usuario,
                  $data->request->get('tituloMensaje'),
                  $data->request->get('textoMensaje')
              );
          }

          $usersIds = $data->request->get('idUsuarioRecibe');

          foreach ($usersIds as $userId) {
              $userRecibe = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $userId));
              if($userRecibe instanceof Usuario){
                  $mensajeService->newMensajeUsuario($userRecibe, $mensaje);
              }
          }

          if (!empty($data->files->get('archivos'))) {
              foreach ($data->files->get('archivos') as $archivo) {
                  if ($archivo !== null) {
                    $archivoService =  $this->get('boletines.servicios.archivo');
                    $archivoService->createMensajeArchivo($archivo, $usuario, $mensaje);
                  }
              }
          }

        } else {
            return $this->redirect($this->generateUrl('login'), 301);
        }

        return true;
    }

    public function saveBorradorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        if ($usuario instanceof Usuario) {
            $mensajeService = $this->get('boletines.servicios.mensaje');

            $usersIds = $request->request->get('idUsuarioRecibe');

            if ($request->request->get('idMensajeBorrador')) {
                $mensajeService->updateBorrador(
                    $usuario,
                    $request->request->get('tituloMensaje'),
                    $request->request->get('textoMensaje'),
                    $usersIds,
                    $request->request->get('idMensajeBorrador')
                );
            } else {
                $mensajeService->saveBorrador(
                    $usuario,
                    $request->request->get('tituloMensaje'),
                    $request->request->get('textoMensaje'),
                    $usersIds
                );
            }
        }

        $this->get('session')->getFlashBag()->add('success', 'Borrador guardado con éxito');
        return $this->redirect($this->generateUrl('mensaje'), 301);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $mensajeService =  $this->get('boletines.servicios.mensaje');
        $mensajeUsuario = $mensajeService->deleteMensaje($usuario, $id);

        $this->get('session')->getFlashBag()->add('success', 'Borrado con éxito');
        return $this->redirect($this->generateUrl('mensaje'), 301);
    }

    public function deleteCheckedMensajesAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
          $em = $this->getDoctrine()->getManager();
          $usuario = $this->getUser();

          $mensajesIds = $request->request->get('idMensajeBorrar');

          if (! empty($mensajesIds)) {
              $mensajeService =  $this->get('boletines.servicios.mensaje');
              $mensajeService->deleteMensajesUsuario($mensajesIds);
          }
        }

        $this->get('session')->getFlashBag()->add('success', 'Borrados con éxito');
        return $this->redirect($this->generateUrl('mensaje'), 301);
    }

    public function autocompletarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $institucion = $this->getUser()->getInstitucion();

        $query = $em->createQueryBuilder()
            ->select('u')
            ->from('BoletinesBundle:Usuario', 'u')
            ->where('LOWER(u.nombre) LIKE LOWER(:query) OR LOWER(u.apellido) LIKE LOWER(:query)')
            ->andWhere('u.institucion = :institucion')
            ->setParameter('query', '%'.$request->query->get('query').'%')
            ->setParameter('institucion', $institucion)
            ->getQuery();
        $entities = $query->getResult();

        $data = [];
        foreach($entities as $e) {
            $entity = [
                'id' => $e->getId(),
                'nombre' => $e->getNombre(),
                'apellido' => $e->getApellido()
            ];
            switch($e->getRol()) {
                case 'ROLE_DOCENTE':
                    $docente = $em->getRepository('BoletinesBundle:Docente')->find($e->getIdEntidadAsociada());
                    if ($docente->getFoto()) {
                      $entity['fotoWebPath'] = $docente->getFotoWebPath();
                    }
                    break;

                case 'ROLE_ALUMNO':
                    $alumno = $em->getRepository('BoletinesBundle:Alumno')->find($e->getIdEntidadAsociada());
                    if ($alumno->getFoto()) {
                      $entity['fotoWebPath'] = $alumno->getFotoWebPath();
                    }
                    break;

                default:
                    break;
            }
            $data[] = $entity;
        }

        return new Response(json_encode($data));
    }
}
