<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 18-May-15
 * Time: 11:49 AM
 */

namespace Acme\boletinesBundle\Servicios;
use Doctrine\ORM\EntityManager;


class SesionService {
    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }
/*
 * Para Obtener el usuario que esta actuando
 * */
    public function obtenerUsuario(){
        $usuario =  $this->em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('id' => 1));
        return $usuario;
    }
/*
 * Para obtener la entidad asociada a un usuario en particular *
 * */
    public function obtenerEntidadRelacionada($usuario){
        //TODO: if($usuario->getRol)
      $entidadRelacioada =  $this->em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => 1));
        return $entidadRelacioada;
    }

 /*
 * Para obtener la entidad relacionada con el usuario que esta actuando
 **/
    public function obtenerMiEntidadRelacionada(){
        $entidadRelacioada =  $this->em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => 1));
        return $entidadRelacioada;
    }
}