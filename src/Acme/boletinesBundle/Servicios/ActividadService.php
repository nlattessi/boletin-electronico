<?php

namespace Acme\boletinesBundle\Servicios;

use Doctrine\ORM\EntityManager;

use Acme\boletinesBundle\Entity\Actividad;
use Acme\boletinesBundle\Entity\Alumno;
use Acme\boletinesBundle\Entity\Usuario;
use Acme\boletinesBundle\Utils\Herramientas;

class ActividadService {

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function crearActividad($nombre, $descripcion, $fechaInicio, $horaInicio, $fechaFin, $horaFin, $usuario,
        $institucion = null, $establecimiento = null, $materia = null)
    {
        $actividad = new Actividad();
        $actividad->setNombre($nombre);
        $actividad->setDescripcion($descripcion);
        $actividad->setFechaHoraInicio(Herramientas::fechaHoraADatetime($fechaInicio, $horaInicio));
        $actividad->setFechaHoraFin(Herramientas::fechaHoraADatetime($fechaFin, $horaFin));
        $actividad->setCreationTime(new \DateTime('now'));
        $actividad->setUpdateTime(new \DateTime('now'));
        $actividad->setUsuarioCarga($usuario);

        if ($institucion != null) {
            $actividad->setInstitucion($institucion);
        }

        if ($establecimiento != null) {
            $actividad->setEstablecimiento($establecimiento);
        }

        if ($materia != null) {
            $actividad->setMateria($materia);
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
            case 'ROLE_ADMINISTRATIVO':
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

    public function getProximasActividadesByAlumnoId($id)
    {
        $proxActividades = [];
        $alumno = $this->getAlumnoById($id);

        if ($alumno instanceof Alumno) {
            $user = $alumno->getUsuario();

            if ($user instanceof Usuario) {
                $actividades = $this->getActividadesAlumno($alumno->getUsuario());
                $hoy = new \DateTime();
                $proxActividades = array_filter($actividades, function($actividad) use ($hoy) {
                    return $actividad->getFechaHoraInicio() > $hoy;
                });
            }
        }

        return $proxActividades;
    }

    private function getActividadesInstitucion($institucion)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Actividad')->createQueryBuilder('a')
            ->where('a.institucion = ?1')
            ->orderBy('a.fechaHoraInicio', 'ASC')
            ->setParameter(1, $institucion);

        return $queryBuilder->getQuery()->getResult();
    }

    private function getActividadesEstablecimiento($establecimiento)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Actividad')->createQueryBuilder('a')
            ->where('a.establecimiento = ?1')
            ->orderBy('a.fechaHoraInicio', 'ASC')
            ->setParameter(1, $establecimiento);

        return $queryBuilder->getQuery()->getResult();
    }

    private function getActividadesMateria($materia)
    {
        $queryBuilder = $this->em->getRepository('BoletinesBundle:Actividad')->createQueryBuilder('a')
            ->where('a.materia = ?1')
            ->orderBy('a.fechaHoraInicio', 'ASC')
            ->setParameter(1, $materia);

        return $queryBuilder->getQuery()->getResult();
    }

    private function getActividadesAdmin($user)
    {
        // TODO ???
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
            // Mergeo pero borro repetidos
            $merge = array_merge($actividadesEstablecimientoHijo, $actividades);
            $actividades = array_map("unserialize", array_unique(array_map("serialize", $merge)));

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
/*Obtener de otra forma las materias del usuario
 *
        foreach ($user->getEntidadAsociada()->getMaterias() as $materia) {
            $actividadesMateria = $this->getActividadesMateria($materia);
            $actividades = array_merge($actividadesMateria, $actividades);
        }
*/
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

        $establecimiento = $this->em->getRepository('BoletinesBundle:UsuarioEstablecimiento')->findOneBy(['usuario' => $user]);
        $actividadesEstablecimiento = $this->getActividadesEstablecimiento($establecimiento);
        $actividades = array_merge($actividadesEstablecimiento, $actividades);

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

    private function getAlumnoById($id)
    {
        return $this->em->getRepository('BoletinesBundle:Alumno')->find($id);
    }

}
