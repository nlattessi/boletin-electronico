<?php

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

    public function getActividadByUser($user)
    {
        switch($user->getRol()) {
            case 'ROLE_ADMIN':
                $actividades = $this->getActividadesAdmin($user);
                break;
            case 'ROLE_PADRE':
                $actividades = $this->getActividadesPadre($user);
                break;
            case 'ROLE_ALUMNO':
                $actividades = $this->getActividadesAlumno($user);
                break;
            case 'ROLE_DOCENTE':
                $actividades = $this->getActividadesDocente($user);
                break;
            case 'ROLE_DIRECTIVO':
                $actividades = $this->getActividadesDirectivo($user);
                break;
            case 'ROLE_BEDEL':
                $actividades = $this->getActividadesBedel($user);
                break;
            default:
                $actividades = [];
                break;
        }

        return $actividades;
    }

    private function getActividadesInstitucion($institucion)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Actividad')->createQueryBuilder('a')
            ->where('a.institucion = ?1')
            ->setParameter(1, $institucion);

        return $queryBuilder->getQuery()->getResult();
    }

    private function getActividadesEstablecimiento($establecimiento)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Actividad')->createQueryBuilder('a')
            ->where('a.establecimiento = ?1')
            ->setParameter(1, $establecimiento);

        return $queryBuilder->getQuery()->getResult();
    }

    private function getActividadesMateria($materia)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Actividad')->createQueryBuilder('a')
            ->where('a.materia = ?1')
            ->setParameter(1, $materia);

        return $queryBuilder->getQuery()->getResult();
    }

    private function getActividadesAdmin($user)
    {
        $actividades = [];

        return $actividades;
    }

    private function getActividadesPadre($user)
    {
        $actividades = [];

        $actividadesInstitucion = $this->getActividadesInstitucion($user->getInstitucion());
        $actividades = array_merge($actividadesInstitucion, $actividades);

        $actividadesEstablecimiento = $this->getActividadesEstablecimiento($user->getEntidadAsociada()->getEstablecimiento());
        $actividades = array_merge($actividadesEstablecimiento, $actividades);

        $hijos = $this->getHijos($user->getEntidadAsociada());
        foreach ($hijos as $hijo) {
            $actividadesEstablecimientoHijo = $this->getActividadesEstablecimiento($hijo->getEstablecimiento());
            $actividades = array_merge($actividadesEstablecimientoHijo, $actividades);

            foreach ($hijo->getMaterias() as $materia) {
                $actividadesMateria = $this->getActividadesMateria($materia);
                $actividades = array_merge($actividadesMateria, $actividades);
            }
        }

        return $actividades;
    }

    private function getActividadesAlumno($user)
    {
        $actividades = [];

        $actividadesInstitucion = $this->getActividadesInstitucion($user->getInstitucion());
        $actividades = array_merge($actividadesInstitucion, $actividades);

        $actividadesEstablecimiento = $this->getActividadesEstablecimiento($user->getEntidadAsociada()->getEstablecimiento());
        $actividades = array_merge($actividadesEstablecimiento, $actividades);

        foreach ($user->getEntidadAsociada()->getMaterias() as $materia) {
            $actividadesMateria = $this->getActividadesMateria($materia);
            $actividades = array_merge($actividadesMateria, $actividades);
        }

        return $actividades;
    }

    private function getActividadesDocente($user)
    {
        $actividades = [];

        $actividadesInstitucion = $this->getActividadesInstitucion($user->getInstitucion());
        $actividades = array_merge($actividadesInstitucion, $actividades);

        $actividadesEstablecimiento = $this->getActividadesEstablecimiento($user->getEntidadAsociada()->getEstablecimiento());
        $actividades = array_merge($actividadesEstablecimiento, $actividades);

        $materias = $this->getMateriasPorDocente($user->getEntidadAsociada());

        foreach ($materias as $materia) {
            $actividadesMateria = $this->getActividadesMateria($materia);
            $actividades = array_merge($actividadesMateria, $actividades);
        }

        return $actividades;
    }

    private function getActividadesDirectivo($user)
    {
        $actividades = [];

        $actividadesInstitucion = $this->getActividadesInstitucion($user->getInstitucion());
        $actividades = array_merge($actividadesInstitucion, $actividades);

        foreach($user->getInstitucion()->getEstablecimientos() as $establecimiento) {
            $actividadesEstablecimiento = $this->getActividadesEstablecimiento($establecimiento);
            $actividades = array_merge($actividadesEstablecimiento, $actividades);
        }

        return $actividades;
    }

    private function getActividadesBedel($user)
    {
        $actividades = [];

        $actividadesInstitucion = $this->getActividadesInstitucion($user->getInstitucion());
        $actividades = array_merge($actividadesInstitucion, $actividades);

        /* NO TIENE ESTABLECIMIENTO? */
        // $actividadesEstablecimiento = $this->getActividadesEstablecimiento($user->getEntidadAsociada()->getEstablecimiento());
        // $actividades = array_merge($actividadesEstablecimiento, $actividades);

        return $actividades;
    }

    private function getHijos($padre)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Alumno')->createQueryBuilder('a')
            ->where('a.padre1 = ?1')
            ->orWhere('a.padre2 = ?1')
            ->setParameter(1, $padre);

        return $queryBuilder->getQuery()->getResult();
    }

    private function getMateriasPorDocente($docente)
    {
        $materias = [];

        $materiasDocente = $this->em->getRepository('BoletinesBundle:DocenteMateria')->findBy(['docente' => $docente]);
        foreach ($materiasDocente as $materiaDocente) {
            $materia = $materiaDocente->getMateria();
            if($materia->isActivo()) {
                $materias[] = $materia;
            }
        }

        return $materias;
    }
}
