<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 18-Jan-16
 * Time: 12:51 PM
 */

namespace Acme\boletinesBundle\Controller;
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

    public function pruebaAction(Request $request){

        $user = $this->getUser();
        $muchosAMuchos =  $this->get('boletines.servicios.muchosamuchos');
        $establecimientos = $muchosAMuchos->obtenerEstablecimientosPorUsuario($user);
        $materias = $muchosAMuchos->obtenerMateriasPorEstablecimientos($establecimientos);
        if($request->get('busqeval')){
            $evaluacionService =  $this->get('boletines.servicios.evaluacion');
            $evaluaciones = $evaluacionService->evaluacionesPorMateriaReporte($request->get('fmateria'));
            $response = new JsonResponse();
            $response->setData($evaluaciones);
            return $response;
        }

        if($request->getMethod() == 'POST') {
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

            $this->testImpresion($qb->getQuery());



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
            $query->setDQL("SELECT a.id, c.nombre FROM BoletinesBundle:Alumno a INNER JOIN BoletinesBundle:Calificacion b WITH a.id = b.alumno and b.evaluacion = 5 INNER JOIN BoletinesBundle:ValorCalificacion c WITH c.id = b.valor WHERE 1=1 ORDER BY c.valor DESC");



            $result = $query->getResult();

            print json_encode($result);
            exit;

        }

        return $this->render(
            'BoletinesBundle:Reporte:alumnoEj.html.twig',
            array(
                'materias' => $materias,
            )
        );
    }
}