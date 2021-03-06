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
use Symfony\Component\HttpFoundation\Session\Session;

class MuchosAmuchosService {

    protected $em;
    private $session;
    private $endYear;
    private $startYear;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
        $this->session = new Session();
        $this->endYear = $this->session->get('endYear');
        $this->startYear = $this->session->get('startYear');
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

    /* DEPRECADA */
    // public function obtenerMateriasPorDocente($docente){
    //     $materiaes = array();
    //
    //     $materiasDocente = $this->em->getRepository('BoletinesBundle:DocenteMateria')->find(array('idDocente' => $docente));
    //     foreach($materiasDocente as $materiaDocente){
    //         $materiaes= $materiaDocente->getMateria();
    //     }
    //     return $materiaes;
    // }
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

        if($usuario->getRol()->getNombre()== 'ROLE_DIRECTIVO' or $usuario->getRol()->getNombre() == 'ROLE_ADMINISTRATIVO'){
            $establecimientos =  $this->em->getRepository('BoletinesBundle:Establecimiento')->findBy(array('institucion' => $usuario->getInstitucion()));
        }else{
            $establecimientosUsuario = $this->em->getRepository('BoletinesBundle:UsuarioEstablecimiento')->findBy(array('usuario' => $usuario));
            foreach($establecimientosUsuario as $establecimientoUsuario){
                $establecimientos[] = $establecimientoUsuario->getEstablecimiento();
            }
        }


        return $establecimientos;
    }

    public function obtenerUsuariosPorEstablecimiento($establecimiento){
        $usuarios = [];

        $establecimientosUsuario = $this->em->getRepository('BoletinesBundle:UsuarioEstablecimiento')->findBy(['establecimiento' => $establecimiento]);
        foreach($establecimientosUsuario as $establecimientoUsuario){
            $usuarios[] = $establecimientoUsuario->getUsuario();
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
            $query = $this->em->createQueryBuilder()
                ->select('a')
                ->from('BoletinesBundle:Alumno','a')
                ->where('a.establecimiento = :establecimiento')
                ->andWhere('a.creationTime > :startYear')
                ->andWhere('a.creationTime < :endYear')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
                ->getQuery();

            $alumnosEstablecimientos = $query->getResult();
            $alumnos = array_merge($alumnosEstablecimientos, $alumnos);
        }

        return $alumnos;
    }

    public function obtenerPadresPorEstablecimientos($establecimientos)
    {
        $padres = array();
        foreach($establecimientos as $establecimiento) {
            $query = $this->em->createQueryBuilder()
                ->select('p')
                ->from('BoletinesBundle:Padre','p')
                ->where('p.establecimiento = :establecimiento')
                ->andWhere('p.creationTime > :startYear')
                ->andWhere('p.creationTime < :endYear')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
                ->getQuery();

            $padresEstablecimientos  = $query->getResult();
            $padres = array_merge($padresEstablecimientos, $padres);
        }

        return $padres;
    }

    public function obtenerDocentesPorEstablecimientos($establecimientos)
    {
        $docentes = array();
        foreach($establecimientos as $establecimiento) {
            $query = $this->em->createQueryBuilder()
                ->select('d')
                ->from('BoletinesBundle:Docente', 'd')
                ->where('d.establecimiento = :establecimiento')
                //->andWhere('d.creationTime > :startYear')
                //->andWhere('d.creationTime < :endYear')
                ->setParameter('establecimiento', $establecimiento)
                //->setParameter('startYear', $this->startYear)
                //->setParameter('endYear', $this->endYear)
                ->getQuery();

            $docenteEstablecimientos  = $query->getResult();
            $docentes = array_merge($docenteEstablecimientos, $docentes);
        }

        return $docentes;
    }

    public function obtenerMateriasPorEstablecimientos($establecimientos)
    {
        $materias = array();
        foreach($establecimientos as $establecimiento) {
            $query = $this->em->createQueryBuilder()
                ->select('m')
                ->from('BoletinesBundle:Materia', 'm')
                ->where('m.establecimiento = :establecimiento')
                ->andWhere('m.creationTime > :startYear')
                ->andWhere('m.creationTime < :endYear')
                ->andWhere('m.activo = true')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
                ->getQuery();

            $materiaEstablecimientos  = $query->getResult();
            $materias = array_merge($materiaEstablecimientos, $materias);
        }

        return $materias;
    }

    public function obtenerPeriodosPorEstablecimiento($establecimiento)
    {
        $query = $this->em->createQueryBuilder()
            ->select('p')
            ->from('BoletinesBundle:Periodo', 'p')
            ->where('p.establecimiento = :establecimiento')
            ->andWhere('p.creationTime > :startYear')
            ->andWhere('p.creationTime < :endYear')
            ->setParameter('establecimiento', $establecimiento)
            ->setParameter('startYear', $this->startYear)
            ->setParameter('endYear', $this->endYear)
            ->getQuery();

        $periodo  = $query->getResult();

        return $periodo;
    }

    public function obtenerPeriodosPorEstablecimientos($establecimientos)
    {
        $periodos = array();

        foreach($establecimientos as $establecimiento) {
            $query = $this->em->createQueryBuilder()
                ->select('p')
                ->from('BoletinesBundle:Periodo', 'p')
                ->where('p.establecimiento = :establecimiento')
                ->andWhere('p.creationTime > :startYear')
                ->andWhere('p.creationTime < :endYear')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
                ->getQuery();

            $result  = $query->getResult();

            $periodos = array_merge($result, $periodos);
        }

        return $periodos;
    }

    public function obtenerNotasAlumno($periodos, $alumno)
    {
        $notas = array();
        foreach($periodos as $periodo) {
            $query = $this->em->createQueryBuilder()
                ->select('np')
                ->from('BoletinesBundle:NotaPeriodo', 'np')
                ->where('np.periodo = :periodo')
                ->andWhere('np.alumno = :alumno')
                ->setParameter('periodo', $periodo->getId())
                ->setParameter('alumno', $alumno->getId())
                ->getQuery();

            $result  = $query->getResult();
            $notas = array_merge($result, $notas);
        }

        return $notas;
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
                ->andWhere('u.creationTime > :startYear')
                ->andWhere('u.creationTime < :endYear')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('rol', $rol)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
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
                ->andWhere('c.validada = :boolValue')
                ->setParameter('boolValue', false)
                ->getQuery();

            $calificaciones = array_merge($query->getResult(), $calificaciones);
        }

        return $calificaciones;
    }

    public function obtenerGruposPorEstablecimientos($establecimientos)
    {
        $grupos = array();
        foreach($establecimientos as $establecimiento) {

            $query = $this->em->createQueryBuilder()
                ->select('gu')
                ->from('BoletinesBundle:GrupoUsuario', 'gu')
                ->where('gu.establecimiento = :establecimiento')
                ->andWhere('gu.creationTime > :startYear')
                ->andWhere('gu.creationTime < :endYear')
                ->andWhere('gu.activo = true')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
                ->getQuery();

            $gruposEstablecimientos  = $query->getResult();
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
            $query = $this->em->createQueryBuilder()
                ->select('ga')
                ->from('BoletinesBundle:GrupoAlumno', 'ga')
                ->where('ga.establecimiento = :establecimiento')
                ->andWhere('ga.creationTime > :startYear')
                ->andWhere('ga.creationTime < :endYear')
                ->andWhere('ga.activo = true')
                ->setParameter('establecimiento', $establecimiento)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
                ->getQuery();

            $gruposEstablecimientos  = $query->getResult();
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
                ->andWhere('c.creationTime > :startYear')
                ->andWhere('c.creationTime < :endYear')
                ->setParameter('establecimiento', $establecimiento)
                ->andWhere('c.validado = :boolValue')
                ->setParameter('boolValue', false)
                ->setParameter('startYear', $this->startYear)
                ->setParameter('endYear', $this->endYear)
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

    public function obtenerBullyingPorInstitucion($institucion){
        $bullyings = $this->em->getRepository('BoletinesBundle:Bullying')->findAll();

        $data = [];
        foreach ($bullyings as $bullying) {
            if ($bullying->getAlumno()->getUsuario()->getInstitucion() == $institucion) {
                $data[] = $bullying;
            }
        }

        return $data;
    }

    /** DEPRECADA **/
    public function obtenerUsuariosPorInstitucion($institucion)
    {
        return $this->em->getRepository('BoletinesBundle:Usuario')->findBy(['institucion' => $institucion]);
    }
}
