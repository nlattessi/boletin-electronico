<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 28-May-15
 * Time: 11:22 AM
 */
namespace Acme\boletinesBundle\Servicios;
use Acme\boletinesBundle\Entity\Actividad;
use Acme\boletinesBundle\Entity\AlumnoAsistencia;
use Acme\boletinesBundle\Entity\AlumnoGrupoAlumno;
use Acme\boletinesBundle\Entity\AlumnoMateria;
use Acme\boletinesBundle\Entity\MateriaActividad;
use Acme\boletinesBundle\Entity\DocenteMateria;
use Acme\boletinesBundle\Entity\ExamenArchivo;
use Acme\boletinesBundle\Entity\GrupoAlumnoMateria;
use Acme\boletinesBundle\Entity\MateriaArchivo;
use Acme\boletinesBundle\Entity\UsuarioEstablecimiento;
use Acme\boletinesBundle\Entity\UsuarioGrupoUsuario;
use Doctrine\ORM\EntityManager;

class MuchosAmuchosService {

    protected $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function asociarAlumnoMateria($alumno, $materia){
        $alumnoMateria = new AlumnoMateria($alumno, $materia);
        $this->em->persist($alumnoMateria);
        $this->em->flush();

        return $alumnoMateria;
    }

    public function obtenerMateriasPorAlumno($alumno){
        $materias = array();

        $alumnosMaterias = $this->em->getRepository('BoletinesBundle:AlumnoMateria')->find(array('idAlumno' => $alumno));
        foreach($alumnosMaterias as $alumnoMateria){
            $materias = $alumnoMateria->getMateria();
        }
        return $materias;

    }

    public function obtenerAlumnosPorMateria($materia){
        $alumnos = array();

        $alumnosMaterias = $this->em->getRepository('BoletinesBundle:AlumnoMateria')->findBy(array('materia' => $materia));
        foreach($alumnosMaterias as $alumnoMateria){
            array_push($alumnos, $alumnoMateria->getAlumno());
        }
        return $alumnos;
    }

    public function asociarMateriaActividad($calendario, $actividad){
        $calendarioActividad = new MateriaActividad($calendario, $actividad);
        $calendarioActividad->setMateria($calendario);
        $calendarioActividad->setActividad($actividad);
        $this->em->persist($calendarioActividad);
        $this->em->flush();

        return $calendarioActividad;
    }

    public function obtenerActividadesPorMateria($calendario){
        $actividades = array();

        $actividadesMateria = $this->em->getRepository('BoletinesBundle:MateriaActividad')->find(array('idMateria' => $calendario));
        foreach($actividadesMateria as $actividadMateria){
            $actividades= $actividadMateria->getActividad();
        }
        return $actividades;
    }
    public function obtenerMateriasPorActividad($actividad){
        $calendarios = array();

        $actividadesMateria = $this->em->getRepository('BoletinesBundle:MateriaActividad')->find(array('idActividad' => $actividad));
        foreach($actividadesMateria as $actividadMateria){
            $calendarios= $actividadMateria->getMateria();
        }
        return $calendarios;
    }

    public function asociarAlumnoGrupoAlumno($alumno, $grupoAlumno){
        $alumnoGrupoAlumno = new AlumnoGrupoAlumno($alumno, $grupoAlumno);

        $this->em->persist($alumnoGrupoAlumno);
        $this->em->flush();

        return $alumnoGrupoAlumno;
    }

    public function obtenerAlumnosPorGrupoAlumno($grupoAlumno){
        $alumnos = array();

        $alumnosGrupoAlumnos = $this->em->getRepository('BoletinesBundle:AlumnoGrupoAlumno')->find(array('idGrupoAlumno' => $grupoAlumno));
        foreach($alumnosGrupoAlumnos as $alumnoGrupoAlumno){
            $alumnos = $alumnoGrupoAlumno->getAlumno();
        }
        return $alumnos;
    }
    public function obtenerGruposAlumnoPorAlumno($alumno){
        $grupoAlumnos = array();

        $alumnosGrupoAlumnos = $this->em->getRepository('BoletinesBundle:AlumnoGrupoAlumno')->find(array('idAlumno' => $alumno));
        foreach($alumnosGrupoAlumnos as $alumnoGrupoAlumno){
            $grupoAlumnos= $alumnoGrupoAlumno->getGrupoAlumno();
        }
        return $grupoAlumnos;
    }

    public function asociarAlumnoAsistencia($alumno, $asistencia){
        $alumnoAsistencia = new AlumnoAsistencia($alumno, $asistencia);
        $this->em->persist($alumnoAsistencia);
        $this->em->flush();

        return $alumnoAsistencia;
    }
//REPLICADA EN AasistenciaSservice
    public function obtenerAsistenciasPorAlumno($alumno){
        $asistenciaes = array();

        $asistenciasAlumno = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->find(array('idAlumno' => $alumno));
        foreach($asistenciasAlumno as $asistenciaAlumno){
            $asistenciaes= $asistenciaAlumno->getAsistencia();
        }
        return $asistenciaes;
    }



    public function obtenerAlumnosPorAsistencia($asistencia){
        $alumnos = array();

        $asistenciasAlumno = $this->em->getRepository('BoletinesBundle:AlumnoAsistencia')->find(array('idAsistencia' => $asistencia));
        foreach($asistenciasAlumno as $asistenciaAlumno){
            $alumnos= $asistenciaAlumno->getAlumno();
        }
        return $alumnos;
    }

    public function asociarDocenteMateria($docente, $materia){
        $docenteMateria = new DocenteMateria($docente, $materia);

        $this->em->persist($docenteMateria);
        $this->em->flush();

        return $docenteMateria;
    }

    public function obtenerMateriasPorDocente($docente){
        $materiaes = array();

        $materiasDocente = $this->em->getRepository('BoletinesBundle:DocenteMateria')->find(array('idDocente' => $docente));
        foreach($materiasDocente as $materiaDocente){
            $materiaes= $materiaDocente->getMateria();
        }
        return $materiaes;
    }
    public function obtenerDocentesPorMateria($materia){
        $docentes = array();

        $materiasDocente = $this->em->getRepository('BoletinesBundle:DocenteMateria')->findBy(array('materia' => $materia));
        foreach($materiasDocente as $materiaDocente){
            array_push($docentes, $materiaDocente->getDocente());
        }
        return $docentes;
    }

    public function asociarExamenArchivo($examen, $archivo){
        $examenArchivo = new ExamenArchivo($examen, $archivo);
        $this->em->persist($examenArchivo);
        $this->em->flush();

        return $examenArchivo;
    }

    public function obtenerArchivosPorExamen($examen){
        $archivos = array();

        $examenArchivos = $this->em->getRepository('BoletinesBundle:ExamenArchivo')->find(array('idExamen' => $examen));
        foreach($examenArchivos as $archivoExamen){
            $archivos= $archivoExamen->getArchivo();
        }
        return $archivos;
    }
    public function obtenerExamenesPorArchivo($archivo){
        $examenes = array();

        $examenArchivos = $this->em->getRepository('BoletinesBundle:ExamenArchivo')->find(array('idArchivo' => $archivo));
        foreach($examenArchivos as $archivoExamen){
            $examenes= $archivoExamen->getExamen();
        }
        return $examenes;
    }

    public function asociarGrupoAlumnoMateria($grupoAlumno, $materia){
        $grupoAlumnoMateria = new GrupoAlumnoMateria($grupoAlumno, $materia);

        $this->em->persist($grupoAlumnoMateria);
        $this->em->flush();

        return $grupoAlumnoMateria;
    }

    public function obtenerMateriasPorGrupoAlumno($grupoAlumno){
        $materias = array();

        $materiasGrupoAlumno = $this->em->getRepository('BoletinesBundle:GrupoAlumnoMateria')->findBy(array('grupoAlumno' => $grupoAlumno));
        foreach($materiasGrupoAlumno as $materiaGrupoAlumno){
            $materias= $materiaGrupoAlumno->getMateria();
        }
        return $materias;
    }
    public function obtenerGrupoAlumnosPorMateria($idMateria){
        $grupoAlumnos = array();

        $materiasGrupoAlumno = $this->em->getRepository('BoletinesBundle:GrupoAlumnoMateria')->findBy(array('materia' => $idMateria));

        foreach($materiasGrupoAlumno as $materiaGrupoAlumno){
            array_push( $grupoAlumnos, $materiaGrupoAlumno->getGrupoAlumno());
        }
        return $grupoAlumnos;
    }

    public function asociarMateriaArchivo($materia, $archivo){
        $materiaArchivo = new MateriaArchivo($materia, $archivo);

        $this->em->persist($materiaArchivo);
        $this->em->flush();

        return $materiaArchivo;
    }

    public function obtenerArchivosPorMateria($materia){
        $archivos = array();

        $archivosMateria = $this->em->getRepository('BoletinesBundle:MateriaArchivo')->findBy(array('materia' => $materia));
        foreach($archivosMateria as $archivoMateria){
            array_push( $archivos, $archivoMateria->getArchivo());
        }
        return $archivos;
    }
    public function obtenerMateriasPorArchivo($archivo){
        $materias = array();

        $archivosMateria = $this->em->getRepository('BoletinesBundle:MateriaArchivo')->find(array('idArchivo' => $archivo));
        foreach($archivosMateria as $archivoMateria){
            $materias= $archivoMateria->getMateria();
        }
        return $materias;
    }

    public function asociarUsuarioEstablecimiento($usuario, $establecimiento){
        $usuarioEstablecimiento = new UsuarioEstablecimiento($usuario, $establecimiento);

        $this->em->persist($usuarioEstablecimiento);
        $this->em->flush();

        return $usuarioEstablecimiento;
    }

    public function obtenerEstablecimientosPorUsuario($usuario){
        $establecimientos = array();

        $establecimientosUsuario = $this->em->getRepository('BoletinesBundle:UsuarioEstablecimiento')->findBy(array('usuario' => $usuario));
        foreach($establecimientosUsuario as $establecimientoUsuario){
            $establecimientos[] = $establecimientoUsuario->getEstablecimiento();
        }
        return $establecimientos;
    }
    public function obtenerUsuariosPorEstablecimiento($establecimiento){
        $usuarios = array();

        $establecimientosUsuario = $this->em->getRepository('BoletinesBundle:UsuarioEstablecimiento')->find(array('idEstablecimiento' => $establecimiento));
        foreach($establecimientosUsuario as $establecimientoUsuario){
            $usuarios = $establecimientoUsuario->getUsuario();
        }
        return $usuarios;
    }



    public function asociarUsuarioGrupoUsuario($usuario, $grupoUsuario){
        $usuarioGrupoUsuario = new UsuarioGrupoUsuario($usuario, $grupoUsuario);

        $this->em->persist($usuarioGrupoUsuario);
        $this->em->flush();

        return $usuarioGrupoUsuario;
    }

    public function obtenerGrupoUsuarioesPorUsuario($usuario){
        $grupoUsuarios = array();

        $grupoUsuariosUsuario = $this->em->getRepository('BoletinesBundle:UsuarioGrupoUsuario')->find(array('id' => $usuario));
        foreach($grupoUsuariosUsuario as $grupoUsuarioUsuario){
            $grupoUsuarios= $grupoUsuarioUsuario->getGrupoUsuario();
        }
        return $grupoUsuarios;
    }
    public function obtenerUsuariosPorGrupoUsuario($grupoUsuario){
        $usuarios = array();

        $grupoUsuariosUsuario = $this->em->getRepository('BoletinesBundle:UsuarioGrupoUsuario')->find(array('idGrupoUsuario' => $grupoUsuario));
        foreach($grupoUsuariosUsuario as $grupoUsuarioUsuario){
            $usuarios= $grupoUsuarioUsuario->getUsuario();
        }
        return $usuarios;
    }

    public function obtenerAlumnosPorEstablecimientos($establecimientos)
    {

        $alumnos = array();
        foreach($establecimientos as $establecimiento) {
            $alumnosEstablecimientos = $this->em->getRepository('BoletinesBundle:Alumno')->findBy(array('establecimiento' => $establecimiento));
            $alumnos = array_merge($alumnosEstablecimientos, $alumnos);
        }

        return $alumnos;
    }

    public function obtenerPadresPorEstablecimientos($establecimientos)
    {
        $padres = array();
        foreach($establecimientos as $establecimiento) {
            $padresEstablecimientos = $this->em->getRepository('BoletinesBundle:Padre')->findBy(array('establecimiento' => $establecimiento));
            $padres = array_merge($padresEstablecimientos, $padres);
        }

        return $padres;
    }

    public function obtenerDocentesPorEstablecimientos($establecimientos)
    {
        $docentes = array();
        foreach($establecimientos as $establecimiento) {
            $docenteEstablecimientos = $this->em->getRepository('BoletinesBundle:Docente')->findBy(array('establecimiento' => $establecimiento));
            $docentes = array_merge($docenteEstablecimientos, $docentes);
        }

        return $docentes;
    }

    public function obtenerMateriasPorEstablecimientos($establecimientos)
    {
        $docentes = array();
        foreach($establecimientos as $establecimiento) {
            $docenteEstablecimientos = $this->em->getRepository('BoletinesBundle:Materia')->findBy(array('establecimiento' => $establecimiento));
            $docentes = array_merge($docenteEstablecimientos, $docentes);
        }

        return $docentes;
    }

    public function obtenerUsuariosPorRolPorEstablecimientos($establecimientos, $rol)
    {
        $repository = $this->em->getRepository('BoletinesBundle:UsuarioEstablecimiento');

        $bedeles = array();
        foreach($establecimientos as $establecimiento) {
            $query = $repository->createQueryBuilder('ue')
                ->select('u')
                ->innerJoin('BoletinesBundle:Usuario', 'u' , 'WITH', 'u.id = ue.usuario')
                ->innerJoin('BoletinesBundle:Rol', 'r', 'WITH', 'r.id = u.rol')
                ->where('ue.establecimiento = :establecimiento')
                ->andWhere('r.nombre = :rol')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('rol', $rol)
                ->getQuery();
            $bedeles = array_merge($query->getResult(), $bedeles);
        }

        return $bedeles;
    }

    public function obtenerCalificacionesPorEstablecimientos($establecimientos)
    {
        $repository = $this->em->getRepository('BoletinesBundle:Calificacion');

        $calificaciones = array();
        foreach($establecimientos as $establecimiento) {
            $query = $repository->createQueryBuilder('c')
                ->select('c')
                ->innerJoin('BoletinesBundle:Evaluacion', 'e' , 'WITH', 'e.id = c.evaluacion')
                ->innerJoin('BoletinesBundle:Materia', 'm', 'WITH', 'm.id = e.materia')
                ->where('m.establecimiento = :establecimiento')
                ->setParameter('establecimiento', $establecimiento)
                ->andWhere('c.validada = 0')
                ->getQuery();

            $calificaciones = array_merge($query->getResult(), $calificaciones);
        }

        return $calificaciones;
    }

    public function obtenerGruposPorEstablecimientos($establecimientos)
    {
        $grupos = array();
        foreach($establecimientos as $establecimiento) {
            $gruposEstablecimientos = $this->em->getRepository('BoletinesBundle:GrupoUsuario')->findBy(array('establecimiento' => $establecimiento));
            $grupos = array_merge($gruposEstablecimientos, $grupos);
        }

        return $grupos;
    }

    public function obtenerUsuariosPorGrupo($grupos)
    {
        $usuarios = array();
        foreach($grupos as $grupo) {
            $usuariosGrupos = $this->em->getRepository('BoletinesBundle:UsuarioGrupoUsuario')->findBy(array('grupoUsuario' => $grupo));
            $usuarios = array_merge($usuariosGrupos, $usuarios);
        }

        return $usuarios;
    }

    public function obtenerGruposAlumnosPorEstablecimientos($establecimientos)
    {
        $grupos = array();
        foreach($establecimientos as $establecimiento) {
            $gruposEstablecimientos = $this->em->getRepository('BoletinesBundle:GrupoAlumno')->findBy(array('establecimiento' => $establecimiento));
            $grupos = array_merge($gruposEstablecimientos, $grupos);
        }

        return $grupos;
    }

    public function obtenerConvivenciaPorEstablecimientos($establecimientos)
    {
        $repository = $this->em->getRepository('BoletinesBundle:Convivencia');

        $convivencia = array();
        foreach($establecimientos as $establecimiento) {
            $query = $repository->createQueryBuilder('c')
                ->select('c')
                ->innerJoin('BoletinesBundle:Alumno', 'a' , 'WITH', 'a.id = c.alumno')
                ->where('a.establecimiento = :establecimiento')
                ->setParameter('establecimiento', $establecimiento)
                ->andWhere('c.validado = 0')
                ->getQuery();

            $convivencia = array_merge($query->getResult(), $convivencia);
        }

        return $convivencia;
    }

    public function obtenerDirectivosPorInstitucion($institucion)
    {
        $rolDirectivo = $this->em->getRepository('BoletinesBundle:Rol')->findOneBy(['nombre' => 'ROLE_DIRECTIVO']);

        $directivos = $this->em->getRepository('BoletinesBundle:Usuario')->findBy([
            'rol' => $rolDirectivo,
            'institucion' => $institucion
        ]);

        return $directivos;
    }
}
