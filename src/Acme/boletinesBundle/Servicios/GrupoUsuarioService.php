<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 08-Dec-15
 * Time: 12:01 PM
 */

namespace Acme\boletinesBundle\Servicios;


use Acme\boletinesBundle\Entity\UsuarioGrupoUsuario;
use Doctrine\ORM\EntityManager;

class GrupoUsuarioService {
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function nuevoUsuarioGrupoUsuario($usuario, $grupo){
        $ugu = new UsuarioGrupoUsuario();
        $ugu->setUsuario($usuario);
        $ugu->setGrupoUsuario($grupo);

        $this->em->persist($ugu);
        $this->em->flush();

        return $ugu;
    }
}