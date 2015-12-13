<?php

namespace Acme\boletinesBundle\Entity;


class Bullying
{
    private $id;
    private $alumno;
    private $comentario;
    private $fechaCarga;

    public function getId()
    {
        return $this->id;
    }

    public function setAlumno($alumno)
    {
        $this->alumno = $alumno;
    }

    public function getAlumno()
    {
        return $this->alumno;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;
    }

    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }
}
