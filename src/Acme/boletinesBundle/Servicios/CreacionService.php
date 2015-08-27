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

    public function crearEstablecimiento($data, $institucion){
        $establecimiento = new Establecimiento();

        $establecimiento->setNombre($data->request->get('nombre'));

        if ($data->request->get('ciudad')) {
            $ciudad = $this->em->getRepository('BoletinesBundle:Ciudad')->findOneBy(array('id' => $data->request->get('ciudad')));
            $establecimiento->setCiudad($ciudad);
        }

        $establecimiento->setDireccion($data->request->get('direccion'));
        $establecimiento->setCodigoPostal($data->request->get('codigoPostal'));
        $establecimiento->setLongitud((float) $data->request->get('longitud'));
        $establecimiento->setLatitud((float) $data->request->get('latitud'));
        $establecimiento->setCodigoPais($data->request->get('codigoPais'));
        $establecimiento->setCodigoArea($data->request->get('codigoArea'));
        $establecimiento->setTelefono($data->request->get('telefono'));
        $establecimiento->setEmail($data->request->get('email'));

        if ($data->request->get('fechaInauguracion')) {
            $fecha = new \DateTime($data->request->get('fechaInauguracion'));
        } else {
            $fecha = new \DateTime();
        }
        $establecimiento->setFechaInauguracion($fecha);

        $establecimiento->setMaximoFaltas((int) $data->request->get('maximoFaltas'));
        $establecimiento->setTardesFaltas((int) $data->request->get('tardesFaltas'));
        $establecimiento->setObservaciones($data->request->get('observaciones'));

        if ($institucion) {
            $establecimiento->setInstitucion($institucion);
            $institucion->addEstablecimiento($establecimiento);
            $this->em->persist($institucion);
        }

        $this->em->persist($establecimiento);
        $this->em->flush();

        return $establecimiento;
    }

    public function editarEstablecimiento($data, $id){
        $establecimiento = $this->em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' => $id));

        $establecimiento->setNombre($data->request->get('nombre'));

        if ($data->request->get('ciudad')) {
            $ciudad = $this->em->getRepository('BoletinesBundle:Ciudad')->findOneBy(array('id' => $data->request->get('ciudad')));
            $establecimiento->setCiudad($ciudad);
        }

        $establecimiento->setDireccion($data->request->get('direccion'));
        $establecimiento->setCodigoPostal($data->request->get('codigoPostal'));
        $establecimiento->setLongitud((float) $data->request->get('longitud'));
        $establecimiento->setLatitud((float) $data->request->get('latitud'));
        $establecimiento->setCodigoPais($data->request->get('codigoPais'));
        $establecimiento->setCodigoArea($data->request->get('codigoArea'));
        $establecimiento->setTelefono($data->request->get('telefono'));
        $establecimiento->setEmail($data->request->get('email'));

        if ($data->request->get('fechaInauguracion')) {
            $fecha = new \DateTime($data->request->get('fechaInauguracion'));
        } else {
            $fecha = new \DateTime();
        }
        $establecimiento->setFechaInauguracion($fecha);

        $establecimiento->setMaximoFaltas((int) $data->request->get('maximoFaltas'));
        $establecimiento->setTardesFaltas((int) $data->request->get('tardesFaltas'));
        $establecimiento->setObservaciones($data->request->get('observaciones'));

        $this->em->persist($establecimiento);
        $this->em->flush();

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
