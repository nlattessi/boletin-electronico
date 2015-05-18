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

    public function obtenerUsuario(){
        $usuario =  $this->em->getRepository('BoletinesBundle:Usuario')->findOneBy(array('idUsuario' => 1));
        return $usuario;
    }

    public function obtenerEntidadRelacionada($usuario){
        //TODO: if($usuario->getRol)
      $entidadRelacioada =  $this->em->getRepository('BoletinesBundle:Docente')->findOneBy(array('idDocente' => 1));
        return $entidadRelacioada;
    }
}