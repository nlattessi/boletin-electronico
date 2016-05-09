<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 02-Nov-15
 * Time: 04:34 PM
 */

namespace Acme\boletinesBundle\Servicios;
use Acme\boletinesBundle\Entity\Materia;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class MateriaService {
    protected $em;
    protected $muchosService;
    protected $grupoAlumnosService;
    private $endYear;
    private $startYear;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
        $this->muchosService = new MuchosAmuchosService($this->em);
        $this->grupoAlumnosService = new GrupoAlumnoService($this->em);
        $this->session = new Session();
        $this->endYear = $this->session->get('endYear');
        $this->startYear = $this->session->get('startYear');
    }

    public function cantidadAlumnos($idMateria){
        $as = $this->cantidadAlumnosDirecto($idMateria);
        $aga = $this->cantidadAlumnosGrupoAlumno($idMateria);
        $total = $as + $aga;

        return $total;
    }

    public function listaAlumnos($idMateria){
        $as = $this->listaAlumnosDirecto($idMateria);
        $aga = $this->listaAlumnosGrupoAlumno($idMateria);
        $merged = array_merge($as, $aga);

        return $merged;
    }

    public function cantidadAlumnosDirecto($idMateria){
        return count($this->listaAlumnosDirecto($idMateria));
    }

    public function cantidadAlumnosGrupoAlumno($idMateria){
        $grupos = $this->muchosService->obtenerGrupoAlumnosPorMateria($idMateria);
        $grupoAlumnoService =  $this->get('boletines.servicios.grupoAlumno');
        $total = 0;

        foreach($grupos as $grupo ){
           $total += $grupoAlumnoService->cantidadAlumnos($grupo->getId);
        }


        return $total ;
    }

    public function listaAlumnosDirecto($idMateria){
        $alumnos = $this->muchosService->obtenerAlumnosPorMateria($idMateria);

        return $alumnos;
    }

    public function listaGruposAlumnoPorMateria($idMateria){
        $grupos = $this->muchosService->obtenerGrupoAlumnosPorMateria($idMateria);

        return $grupos;
    }

    public function listaAlumnosGrupoAlumno($idMateria){
        $grupos = $this->muchosService->obtenerGrupoAlumnosPorMateria($idMateria);
        $alumnos =  array();
        foreach($grupos as $g ){
            $alumnos_aux = [];
            foreach($g->getAlumnos() as $alumno) {
                $alumnos_aux[] = $alumno;
            }
            $alumnos = array_merge($alumnos, $alumnos_aux);
        }


        return $alumnos ;
    }

    public function listaMateriasPorDocente($idDocente){
        $materias = array();

        $query = $this->em->createQueryBuilder()
            ->select('d')
            ->from('BoletinesBundle:DocenteMateria','d')
            ->where('d.docente = :docente')
            ->andWhere('d.creationTime > :startYear')
            ->andWhere('d.creationTime < :endYear')
            ->setParameter('docente', $idDocente)
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->getQuery();

        $materiasDocente = $query->getResult();
        foreach($materiasDocente as $materiaDocente){
            $materia = $materiaDocente->getMateria();
            if($materia->isActivo()) {
                $materia->setAlumnos($this->listaAlumnos($materia->getId()));
                $materia->setGruposAlumnos($this->listaGruposAlumnoPorMateria($materia->getId()));
                array_push($materias, $materia);
            }
        }
        return $materias;
    }

    public function listaMateriasPorAlumno($idAlumno){
        $materias = array();

        $query = $this->em->createQueryBuilder()
            ->select('c')
            ->from('BoletinesBundle:Alumno','d')
            ->join('BoletinesBundle:GrupoAlumnoMateria'  , 'c', 'WITH','c.grupoAlumno in d.gruposAlumno  '  )
            ->where('d.alumno = :alumno')
            ->setParameter('alumno', $idAlumno)
            ->getQuery();

        $materiasAlumno = $query->getResult();
        foreach($materiasAlumno as $materiaAlumno){
            $materia = $materiaAlumno->getMateria();
            if($materia->isActivo()) {
                array_push($materias, $materia);
            }
        }
        return $materias;
    }

    public function listaDocentesPorMateria($idMateria){
        $docentes = $this->muchosService->obtenerDocentesPorMateria($idMateria);

        return $docentes;
    }

    public function listaArchivosPorMateria($idMateria){
        $archivos = $this->muchosService->obtenerArchivosPorMateria($idMateria);

        return $archivos;
    }

    public function materiaLoad(Materia $materia){
        $materia->setAlumnos($this->listaAlumnos($materia->getId()));
        //$materia->setArchivos($this->listaArchivosPorMateria($materia->getId()));
        $materia->setDocentes($this->listaDocentesPorMateria($materia->getId()));
        $materia->setGruposAlumnos($this->listaGruposAlumnoPorMateria($materia->getId()));

        return $materia;
    }

    public function materiasPorEstablecimientoReporte($establecimientoId){
         $queryBuilder = $this->em->getRepository('BoletinesBundle:Materia')->createQueryBuilder('m')
            ->select('m.id, m.nombre')
             ->where('m.establecimiento = ?1')
             ->setParameter(1, $establecimientoId);

         $materias = $queryBuilder->getQuery()->getResult();
         return $materias;
     }

}
