<?php
/**
 * Created by PhpStorm.
 * User: fede
 * Date: 18-Nov-15
 * Time: 07:14 PM
 */
namespace Acme\boletinesBundle\Utils;

class WrapperAlumnoAsistencia {

    private $alumno;
    private $asistencias;

    /**
     * @return mixed
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * @param mixed $alumno
     */
    public function setAlumno($alumno)
    {
        $this->alumno = $alumno;
    }

    /**
     * @return mixed
     */
    public function getAsistencias()
    {
        return $this->asistencias;
    }

    /**
     * @param mixed $asistencias
     */
    public function setAsistencias($asistencias)
    {
        $this->asistencias = $asistencias;
    }


}