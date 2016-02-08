<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class NotaPeriodo
{
    private $id;
    private $periodo;
    private $materia;
    private $alumno;
    private $nota;
    private $comentario;
    private $validada = false;
    private $creationTime;
    private $updateTime;


    public function __construct()
    {
        $this->creationTime = new \DateTime();
        $this->updateTime = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPeriodo(Periodo $periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    public function getPeriodo()
    {
        return $this->periodo;
    }

    public function setMateria(Materia $materia)
    {
        $this->materia = $materia;

        return $this;
    }

    public function getMateria()
    {
        return $this->materia;
    }

    public function setAlumno(Alumno $alumno)
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getAlumno()
    {
        return $this->alumno;
    }

    public function setNota(ValorCalificacion $nota)
    {
        $this->nota = $nota;

        return $this;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setValidada($validada)
    {
        $this->validada = $validada;

        return $this;
    }

    public function getValidada()
    {
        return $this->validada;
    }

    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    public function getCreationTime()
    {
        return $this->creationTime;
    }

    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    public function getUpdateTime()
    {
        return $this->updateTime;
    }
}
