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

class MateriaService {
    protected $em;
    protected $muchosService;
    protected $grupoAlumnosService;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
         $this->muchosService = new MuchosAmuchosService($this->em);
        $this->grupoAlumnosService = new GrupoAlumnoService($this->em);
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
            $id = $g->getId();
            $alumnos = array_merge($alumnos, $this->grupoAlumnosService->listaAlumnos($id));
        }


        return $alumnos ;
    }

    public function listaMateriasPorDocente($idDocente){
        $materias = array();

        $materiasDocente = $this->em->getRepository('BoletinesBundle:DocenteMateria')->findBy(array('docente' => $idDocente));
        foreach($materiasDocente as $materiaDocente){
            $materia = $materiaDocente->getMateria();
            $materia->setAlumnos($this->listaAlumnos($materia->getId()));
            $materia->setGruposAlumnos($this->listaGruposAlumnoPorMateria($materia->getId()));
            array_push($materias,$materia );
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
        $materia->setArchivos($this->listaArchivosPorMateria($materia->getId()));
        $materia->setDocentes($this->listaDocentesPorMateria($materia->getId()));

        return $materia;
    }

}