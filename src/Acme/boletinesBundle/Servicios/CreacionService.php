<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 22-Jul-15
 * Time: 05:33 PM
 */
namespace Acme\boletinesBundle\Servicios;
use Acme\boletinesBundle\Entity\Actividad;
use Acme\boletinesBundle\Entity\Establecimiento;
use Acme\boletinesBundle\Entity\Usuario;
use Doctrine\ORM\EntityManager;

class CreacionService {

    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function crearEstablecimiento(){
        //TODO: lógica de creación de un establecimiento
        $establecimiento = new Establecimiento();

        return $establecimiento;
    }
    public function crearUsuario($nombre, $email, $password, $rol, $institucion){
        $usuario = new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setEmail($email);
        $usuario->setPassword($password);

        $usuario->setRol($rol);
        $usuario->setInstitucion($institucion);

        $this->em->persist($usuario);
        $this->em->flush();

        return $usuario;
    }


}