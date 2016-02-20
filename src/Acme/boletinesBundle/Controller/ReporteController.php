<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 18-Jan-16
 * Time: 12:51 PM
 */

namespace Acme\boletinesBundle\Controller;
use Acme\boletinesBundle\Entity\Reporte;
use Acme\boletinesBundle\Utils\Herramientas;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ReporteController  extends Controller  {

    public function testImpresion($query){

        $em = $this->getDoctrine()->getManager();
        $reporte = $em->getRepository('BoletinesBundle:Reporte')->findOneBy(array('id' => 1));

        //$query->setDQL("SELECT a.id, c.nombre FROM BoletinesBundle:Alumno a INNER JOIN BoletinesBundle:Calificacion b WITH a.id = b.alumno and b.evaluacion = 5 INNER JOIN BoletinesBundle:ValorCalificacion c WITH c.id = b.valor WHERE 1=1 ORDER BY c.valor DESC");
        $query->setDQL($reporte->getDql());
        $result = $query->getResult();

        print "123" . json_encode($result);
        exit;
    }

    public function guardarReporte($nombre,$dql, $rol, $institucion){
        $em = $this->getDoctrine()->getManager();
        $reporte = new Reporte($nombre, $dql, $rol,$institucion);
        $em->persist($reporte);
        $em->flush();
    }

    public function cargarMaterias($establecimientoId){
        $materiaService =  $this->get('boletines.servicios.materia');
        $materias = $materiaService->materiasPorEstablecimientoReporte($establecimientoId);
        $response = new JsonResponse();
        $response->setData($materias);
        return $response;
    }

    public function cargarDocentes($establecimientoId){
        $docenteService =  $this->get('boletines.servicios.docente');
        $docentes = $docenteService->docentesPorEstablecimientoReporte($establecimientoId);
        $response = new JsonResponse();
        $response->setData($docentes);
        return $response;
    }

    public function cargarEvauaciones($materiaId){
        $evaluacionService =  $this->get('boletines.servicios.evaluacion');
        $evaluaciones = $evaluacionService->evaluacionesPorMateriaReporte($materiaId);
        $response = new JsonResponse();
        $response->setData($evaluaciones);
        return $response;
    }
    public function cargarEvauacionesMateriaDocente($materiaId, $docenteId){
        $evaluacionService =  $this->get('boletines.servicios.evaluacion');
        $evaluaciones = $evaluacionService->evaluacionesPorMateriaDocenteReporte($materiaId, $docenteId);
        $response = new JsonResponse();
        $response->setData($evaluaciones);
        return $response;
    }
    public function cargarCalificaciones($establecimiento){
        $calificacionService =  $this->get('boletines.servicios.calificacion');
        $valoresCalificacion = $calificacionService->valoresAceptadosReporte($establecimiento);
        $response = new JsonResponse();
        $response->setData($valoresCalificacion);
        return $response;
    }

    public function cargarIdAsistenciaPorFecha($fecha, $materia){
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('a.id')
            ->from('BoletinesBundle:Asistencia', 'a')
            ->where('1=1');
        if($fecha){
            $qb->andWhere("a.fecha = '" . $fecha . "'");
        }
        if($materia){
            $qb->andWhere("a.materia = " . $materia );
        }

        $resultado = $qb->getQuery()->getResult();
        $response = new JsonResponse();
        $response->setData($resultado);
        return $response;
    }
    public function busquedaAjaxAction(Request $request){
        if($request->get('busqmat')){
            return $this->cargarMaterias($request->get('festablecimiento'));
        }
        if($request->get('busqdoc')){
            return $this->cargarDocentes($request->get('festablecimiento'));
        }
        if($request->get('busqeval')){
            return $this->cargarEvauaciones($request->get('fmateria'));
        }
        if($request->get('busqcal')){
            $em = $this->getDoctrine()->getManager();
            $establecimiento = $em->getRepository('BoletinesBundle:Establecimiento')->findOneBy(array('id' =>  $request->get('festablecimiento')));
            return $this->cargarCalificaciones($establecimiento);
        }
        if($request->get('busqasis')){
            $fecha = $request->get('fechaasistencia');
            $materia = $request->get('materiaasistencia');

            return $this->cargarIdAsistenciaPorFecha($fecha, $materia);
        }
        if($request->get('busqevalmatdoc')){
            return $this->cargarEvauacionesMateriaDocente($request->get('fmateria'),$request->get('fdocente'));
        }

    }


    public function newAction(Request $request){

        /**
         * @var $em EntityManager
         */
        $em = $this->getDoctrine()->getManager();
        $columnas = array();

        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);

        if($request->getMethod() == 'POST') {
            $qb = $em->createQueryBuilder();

            //SELECT
            $count = $request->get('count');
            if($count == 'si'){
                $select = "count(a.id)";
                array_push($columnas, 'total');
            }else{
                $select = "a.id";
                array_push($columnas, array ('data' =>'id'));
                $campos = $request->get('campo');
                if($campos){
                    foreach ($campos as $campo) {
                        $select .= ", a." . $campo;
                        array_push($columnas, array ('data' =>$campo));
                    }
                }
            }
            //FROM
            $from = "BoletinesBundle:";
            $from .= $request->get('from');

            $qb->select($select)
                ->from($from, 'a')
                ->where("1=1");

            //WHERE
            $where = $request->get('where');
            if($where){
                $qb->andWhere( $where );
            }

            //JOINS

            $joinT = $request->get('joinTB');
            $joinW = $request->get('joinWB');
            $joinS = $request->get('joinSB');
            if($joinT){
                // $qb->leftJoin($joinT, 'a', 'WITH',$joinW, 'a.id' );
                //Join sin relación explicita
                $qb->join('BoletinesBundle:' .$joinT , 'b', 'WITH', $joinW );
                //$qb->join('BoletinesBundle:ValorCalificacion'  , 'c', 'WITH','c.id = b.valor  '  );
                if($joinS){
                    $qb->addSelect($joinS);
                }

                //Join con relación explicita
                /* $qb->innerJoin('a.grupos', 'b')
                 ->andWhere('b.id = 5');*/
            }
            $joinT = $request->get('joinTC');
            $joinW = $request->get('joinWC');
            $joinS = $request->get('joinSC');
            if($joinT){
                // $qb->leftJoin($joinT, 'a', 'WITH',$joinW, 'a.id' );
                //Join sin relación explicita
                $qb->join('BoletinesBundle:' .$joinT , 'c', 'WITH', $joinW );
                //$qb->join('BoletinesBundle:ValorCalificacion'  , 'c', 'WITH','c.id = b.valor  '  );
                if($joinS){
                    $qb->addSelect($joinS);
                }

                //Join con relación explicita
                /* $qb->innerJoin('a.grupos', 'b')
                 ->andWhere('b.id = 5');*/
            }

            $joinT = $request->get('joinTD');
            $joinW = $request->get('joinWD');
            $joinS = $request->get('joinSD');
            if($joinT){
                // $qb->leftJoin($joinT, 'a', 'WITH',$joinW, 'a.id' );
                //Join sin relación explicita
                $qb->join('BoletinesBundle:' .$joinT , 'd', 'WITH', $joinW );
                //$qb->join('BoletinesBundle:ValorCalificacion'  , 'c', 'WITH','c.id = b.valor  '  );
                if($joinS){
                    $qb->addSelect($joinS);
                }

                //Join con relación explicita
                /* $qb->innerJoin('a.grupos', 'b')
                 ->andWhere('b.id = 5');*/
            }

            $joinT = $request->get('joinTE');
            $joinW = $request->get('joinWE');
            $joinS = $request->get('joinSE');
            if($joinT){
                $qb->join('BoletinesBundle:' .$joinT , 'e', 'WITH', $joinW );
                if($joinS){
                    $qb->addSelect($joinS);
                }
            }

            $query = $qb->getQuery();

            //PERSISTENCIA
            //$nombre = $request->get('nombre');
            $nombre = "HARD-TEST";
            $this->guardarReporte($nombre,$query->getDQL(), null, $user->getInstitucion());

            $result = $query->getResult();

            /*print json_encode(array('data' => $result, 'columns' => $columnas));
            exit;*/
            return $this->render('BoletinesBundle:Reporte:resultado.html.twig', array('columnas' => $columnas,
                'datos' => $result,
                'css_active' => 'reporte',));
        }



        return $this->render(
            'BoletinesBundle:Reporte:new.html.twig',
            array(
                'establecimientos' => $establecimientos,
                'css_active' => 'reporte',
            )
        );
    }


    public function pruebaAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $materias = $muchosAMuchos->obtenerMateriasPorEstablecimientos($establecimientos);
        if($request->get('busqeval')){
            return $this->cargarEvauaciones($request->get('fmateria'));
        }

        if($request->getMethod() == 'POST') {

            //$nombre = $request->get('nombre');
            $nombre = "HARD-TEST";
            $campos = $request->get('campo');
            $count = $request->get('count');
            if($count == 'si'){
                $select = "count(a.id)";
            }else{
                $select = "a.id";
                if($campos){
                    foreach ($campos as $campo) {
                        $select .= ", a." . $campo;
                    }
                }
            }
            $from = "BoletinesBundle:";
            $from .= $request->get('from');

            /**
             * @var $em EntityManager
             */
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();

            $qb->select($select)
                ->from($from, 'a')
            ->where("1=1");
            $where = $request->get('where');
            if($where){
                $qb->andWhere( $where );
            }

            $joinT = $request->get('joinT');
            $joinW = $request->get('joinW');
            if($joinT){
               // $qb->leftJoin($joinT, 'a', 'WITH',$joinW, 'a.id' );
                //Join sin relación explicita
                $qb->join('BoletinesBundle:' .$joinT , 'b', 'WITH','a.id = ' . $joinW );
                $qb->join('BoletinesBundle:ValorCalificacion'  , 'c', 'WITH','c.id = b.valor  '  );
                $qb->addSelect('c.nombre');
                $qb->orderBy('c.valor','DESC');
                //Join con relación explicita
               /* $qb->innerJoin('a.grupos', 'b')
                ->andWhere('b.id = 5');*/
            }
            $query = $qb->getQuery();

            $this->guardarReporte($nombre,$query->getDQL(), null, $user->getInstitucion());


            $result = $query->getResult();


        }

        return $this->render(
            'BoletinesBundle:Reporte:alumnoEj.html.twig',
            array(
                'materias' => $materias,
            )
        );
    }
}
