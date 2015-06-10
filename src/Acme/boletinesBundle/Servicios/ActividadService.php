<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 18-May-15
 * Time: 11:22 AM
 */
namespace Acme\boletinesBundle\Servicios;
use Acme\boletinesBundle\Entity\Actividad;
use Doctrine\ORM\EntityManager;

class ActividadService {

    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function crearActividad($nombre, $descripcion, $fechaDesde, $fechaHasta, $usuario, $archivo){
        $actividad = new Actividad();
        $actividad->setNombreActividad($nombre);
        $actividad->setDescripcionActividad($descripcion);
        $actividad->setFechaDesde($fechaDesde);
        $actividad->setFechaHasta($fechaHasta);
        $actividad->setFechaCreacion(new \DateTime('now'));

        $actividad->setUsuarioCreador($usuario);
        if($archivo != null) {
            $actividad->setArchivo($archivo);
        }

        $this->em->persist($actividad);
        $this->em->flush();

        return $actividad;
    }


}