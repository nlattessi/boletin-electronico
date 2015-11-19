<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 19-Nov-15
 * Time: 04:49 PM
 */

namespace Acme\boletinesBundle\Utils;

use DateTime;


class Herramientas {


    public static function textoADatetime($fechaString){
        $fecha = DateTime::createFromFormat('d/m/Y', $fechaString);
        return $fecha;
    }
}