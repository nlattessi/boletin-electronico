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

    public function setearAlumnoSesionPadre($session, $idPadre)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Alumno')->createQueryBuilder('a')
            ->where('a.padre1 = ?1')
            ->orWhere('a.padre2 = ?1')
            ->setParameter(1, $idPadre)
            ->setMaxResults(1)
        ;
        $alumno = $queryBuilder->getQuery()->getSingleResult();

        $session->set('alumnoActivo',  $alumno);
        $establecimiento =  $this->em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $alumno->getEstablecimiento()->getId()));
        $session->set('establecimientoActivo',  $establecimiento);
    }

    public function cambiarAlumnoSesion($session, $idAlumno)
    {
        $alumno = $this->em->getRepository('BoletinesBundle:Alumno')->findOneBy(array('id' => $idAlumno));
        $session->set('alumnoActivo',  $alumno);
        $establecimiento =  $this->em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $alumno->getEstablecimiento()->getId()));
        $session->set('establecimientoActivo',  $establecimiento);
    }

    public function obtenerHijos($idPadre)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Alumno')->createQueryBuilder('a')
            ->where('a.padre1 = ?1')
            ->orWhere('a.padre2 = ?1')
            ->setParameter(1, $idPadre);
        $hijos = $queryBuilder->getQuery()->getResult();

        return $hijos;
    }

    public function setearDocenteSesion($session, $idDocente){
        $docente = $this->em->getRepository('BoletinesBundle:Docente')->findOneBy(array('id' => $idDocente));
        $session->set('docenteActivo',  $docente);
        $establecimiento =  $this->em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $docente->getEstablecimiento()->getId()));
        $session->set('establecimientoActivo',  $establecimiento);
    }

}
