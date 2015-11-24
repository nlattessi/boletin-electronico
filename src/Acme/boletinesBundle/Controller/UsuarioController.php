<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Entity\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\UsuarioType;

class UsuarioController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Usuario')->findAll();

        return $this->render('BoletinesBundle:Usuario:index.html.twig', array('entities' => $entities));
    }

    public function indexConInstitucionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Institucion')->findAll();

        return $this->render('BoletinesBundle:Usuario:index.admin.html.twig', array('entities' => $entities));
    }

    public function indexConInstitucionSearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if (!($request->getMethod() == 'POST' && $request->request->get('search'))) {
            return new RedirectResponse($this->generateUrl('usuario_index_admin'));
        }
        $repo = $em->getRepository('BoletinesBundle:Institucion');
        $query = $repo->createQueryBuilder('inst')
            ->where('inst.nombre LIKE :search')
            ->setParameter('search', '%'.$request->request->get('search').'%')
            ->getQuery();

        $entities = $query->getResult();

        return $this->render('BoletinesBundle:Usuario:index.admin.html.twig', array('entities' => $entities));
    }

    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        return $this->render('BoletinesBundle:Usuario:show.html.twig', array('usuario' => $usuario));
    }

    public function newAction(Request $request)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $usuario = $this->createEntity($request);
            if($usuario != null) {
                return $this->render('BoletinesBundle:Usuario:show.html.twig', array('usuario' => $usuario));
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();

        return $this->render('BoletinesBundle:Usuario:new.html.twig', array(
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    public function newConInstitucionAction($institucionId,Request $request ){
        $message = "";
        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' => $institucionId));
        if ($request->getMethod() == 'POST') {
            //Esto se llama cuando se hace el submit del form, cuando entro a crear una nueva va con GET y no pasa por aca
            $usuario = $this->createEntityConInstitucion($institucion, $request);
            if($usuario != null) {
                return $this->editConInstitucionAction($institucionId, null);
            } else {
                $message = "Errores";
            }
        }
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();
        return $this->render('BoletinesBundle:Usuario:new2.html.twig', array(
            'institucion' => $institucion,
            'entitiesRelacionadas' => $entitiesRelacionadas));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        if($usuario instanceof Usuario) {
            $em->remove($usuario);
            $em->flush();
        }
       // return $this->indexAction();
    }

    private function createEntity($data)
    {
        $em = $this->getDoctrine()->getManager();


        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('idRol' => $data->request->get('idRol')));
        $creacionService =  $this->get('boletines.servicios.creacion');
        $usuario = $creacionService->crearUsuario($data->request->get('nombre'),
            $data->request->get('email'),
            $data->request->get('password'),
            $rol,
            null);

        return $usuario;
    }
    private function createEntityConInstitucion($institucion, $data)
    {
        $em = $this->getDoctrine()->getManager();

        $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('nombre' => 'ROLE_DIRECTIVO'));
        $creacionService =  $this->get('boletines.servicios.creacion');
        $usuario = $creacionService->crearUsuario($data->request->get('nombre'),
            $data->request->get('apellido'),
            $data->request->get('email'),
            $data->request->get('password'),
            $rol,
            $institucion);

        return $usuario;
    }

    public function editAction($id = null, Request $request = null)
    {
        $message = "";
        if ($request->getMethod() == 'POST') {
            $entity = $this->editEntity($request, $id);
            if($entity != null) {
                return $this->getOneAction($entity->getId());
            } else {
                $message = "Errores";
            }
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));
        $entitiesRelacionadas = $em->getRepository('BoletinesBundle:Rol')->findAll();

        return $this->render('BoletinesBundle:Usuario:edit.html.twig', array(
            'usuario' => $entity,
            'mensaje' => $message,
            'entitiesRelacionadas' => $entitiesRelacionadas
        ));
    }

    public function resetPasswordAction($token = null)
    {
        if ($token == null) {
            return new RedirectResponse($this->generateUrl('login_index'));
        }

        $em = $this->getDoctrine()->getManager();
        $tokenEntity = $em->getRepository('BoletinesBundle:Token')->findOneBy(array('token' => $token));
        if ($tokenEntity instanceof Token) {
            return $this->render('BoletinesBundle:Usuario:emailReset.html.twig', array('token' => $token, 'error' => null));
        } else {
            $this->get('session')->getFlashBag()->add(
                'token',
                'Token ingresado es incorrecto o ha expirado.'
            );
            return new RedirectResponse($this->generateUrl('login_index'));
        }
    }

    public function emailRecoveryPasswordAction()
    {
        return $this->render('BoletinesBundle:Usuario:emailRecover.html.twig');
    }

    public function viewTokensAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('BoletinesBundle:Token');
        $query = $repo->createQueryBuilder('t')
            ->where('t.usuario IS NOT NULL')
            ->getQuery()
        ;

        $tokens = $query->getResult();

        return $this->render('BoletinesBundle:Usuario:viewTokens.html.twig', array('tokens' => $tokens));
    }

    public function doResetPasswordAction(Request $request)
    {
        $token = $request->request->get('token');

        $pass = $request->request->get('password');
        $pass2 = $request->request->get('password2');

        if ($pass != $pass2) {
            return $this->render('BoletinesBundle:Usuario:emailReset.html.twig', array('token' => $token, 'error' => 'Las contraseñas que ha ingresado no concuerdan.'));
        }

        $em = $this->getDoctrine()->getManager();
        $tokenEntity = $em->getRepository('BoletinesBundle:Token')->findOneBy(array('token' => $token));

        if($tokenEntity instanceof Token) {
            $user = $tokenEntity->getUsuario();
            $user->setPassword($pass);
            $tokenEntity->setToken(null);
            $tokenEntity->setUsuario(null);
            $em->persist($user);
            $em->persist($tokenEntity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'token',
                'Su contraseña se ha cambiado exitosamente.'
            );
            return new RedirectResponse($this->generateUrl('login_index'));
        }

        $this->get('session')->getFlashBag()->add(
            'token',
            'Se ha producido un error.'
        );
        return new RedirectResponse($this->generateUrl('login_index'));
    }

    public function sendEmailRecoveryPasswordAction(Request $request)
    {
        $email = $request->request->get('email');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('email' => $email));

        if($user instanceof Usuario) {
            $token = new Token();
            $token->setToken($email);
            $token->setUsuario($user);

            $expire = new \DateTime();
            $expire->modify('+1 hour');
            $token->setExpirationTime($expire);

            $em->persist($token);
            $em->flush();

            //$url = 'http://localhost:8000/usuario/resetpassword/' . $token->getToken(); //HARDCODEADO PARA TEST
            $url = 'http://communitas-dev.herokuapp.com/usuario/resetpassword/' . $token->getToken();

            $message = \Swift_Message::newInstance()
                ->setSubject('Reset password')
                ->setFrom('help@communitas.com')
                //->setTo(array('n_lattessi@hotmail.com', 'fclarat@gmail.com', 'federico.gonzalezc@gmail.com')) //HARDCODEADO PARA TEST
                ->setTo($email) //HARDCODEADO PARA TEST
                ->setBody('Para modificar tu password de Communitas ingresa a <a href="' . $url . '">' . $url . '</a>', 'text/html') //HARDCODEADO PARA TEST
            ;
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add(
                'token',
                'El correo de recuperación ha sido enviado correctamente.'
            );

            return new RedirectResponse($this->generateUrl('login_index'));
        }

        $this->get('session')->getFlashBag()->add(
            'token',
            'No ha sido posible recuperar la contraseña con la direccion de email solicitada.'
        );
        return new RedirectResponse($this->generateUrl('login_index'));
    }

    public function editConInstitucionAction($institucionId = null, Request $request = null){
        $message = "";
        if ($request != null && $request->getMethod() == 'POST') {

            if($request->request->has("borrar")){
                $this->deleteAction($request->request->get('id'));
            }else{
                $entity = $this->editEntity($request, $request->request->get('id'));
                if($entity == null) {
                    $message = "Errores";
                }
            }
        }

        $em = $this->getDoctrine()->getManager();
        $institucion = $em->getRepository('BoletinesBundle:Institucion')->findOneBy(array('id' =>$institucionId));

       $query = $em->createQuery('select u from BoletinesBundle:Usuario u where u.institucion = :institucionId');
        $query->setParameter('institucionId',$institucionId);
        $entities = $query->getResult();



        return $this->render('BoletinesBundle:Usuario:edit2.html.twig', array(
            'entities' => $entities,
            'mensaje' => $message,
            'institucion' => $institucion
        ));
    }

    private function editEntity($data, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => $id));

        $usuario->setNombre($data->request->get('nombre'));
        $usuario->setEmail($data->request->get('email'));
        $usuario->setPassword($data->request->get('password'));
        $idRol = $data->request->get('idRol');

        if($idRol != null && $idRol != '') {
            $rol = $em->getRepository('BoletinesBundle:Rol')->findOneBy(array('id' => $idRol));
            $usuario->setRol($rol);
        }
        $em->persist($usuario);
        $em->flush();

        return $usuario;
    }

    public function new2Action()
    {
        return $this->render('BoletinesBundle:Usuario:new2.html.twig', array());
    }

    public function edit2Action()
    {
        return $this->render('BoletinesBundle:Usuario:edit2.html.twig', array());
    }

    public function getCalendarioAction()
    {
        $events = array(
            'events' => []
        );
        $actividades = array();
        $user = $this->getUser();

        if ($user->esPadre($user)) {
            $users = $this->getHijos($user);
            foreach($users as $user) {
                foreach ($user->getActividades() as $actividades_aux) {
                    $actividades[] = $actividades_aux;
                }
            }

        } else {
            $actividades = $user->getActividades();
        }

        $i = 0;
        foreach($actividades as $actividad) {
            $events['events'][$i]['title'] = $actividad->getNombre();
            $events['events'][$i]['start'] = date_format($actividad->getFechaHoraInicio(), 'Y-m-d\TH:i:s');
            $events['events'][$i]['end'] = date_format($actividad->getFechaHoraFin(), 'Y-m-d\TH:i:s');
            $i++;
        }
        echo json_encode($events, true);exit();
    }


    private function getHijos($user)
    {
        $em = $this->getDoctrine()->getManager();
        $padre = $em->getRepository('BoletinesBundle:Padre')->findBy(array('usuario' => $user));
        $hijos1 = $em->getRepository('BoletinesBundle:Alumno')->findBy(array('padre1' => $padre));
        $hijos2 = $em->getRepository('BoletinesBundle:Alumno')->findBy(array('padre2' => $padre));

        $hijos = array_merge($hijos1, $hijos2);
        $hijos = array_merge($hijos, $padre);

        foreach ($hijos as $hijo) {
            $usuarios[] = $hijo->getUsuario();
        }

        return $usuarios;
    }
}
