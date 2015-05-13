<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Docente
 *
 * @ORM\Table(name="docente", indexes={@ORM\Index(name="usuario_fk_docente", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Docente
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_docente", type="string", length=45, nullable=false)
     */
    private $nombreDocente;

    /**
     * @var string
     *
     * @ORM\Column(name="email_docente", type="string", length=45, nullable=false)
     */
    private $emailDocente;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_docente", type="string", length=45, nullable=false)
     */
    private $telefonoDocente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_docente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDocente;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    /**
     * @return string
     */
    public function getNombreDocente()
    {
        return $this->nombreDocente;
    }

    /**
     * @param string $nombreDocente
     */
    public function setNombreDocente($nombreDocente)
    {
        $this->nombreDocente = $nombreDocente;
    }

    /**
     * @return string
     */
    public function getEmailDocente()
    {
        return $this->emailDocente;
    }

    /**
     * @param string $emailDocente
     */
    public function setEmailDocente($emailDocente)
    {
        $this->emailDocente = $emailDocente;
    }

    /**
     * @return string
     */
    public function getTelefonoDocente()
    {
        return $this->telefonoDocente;
    }

    /**
     * @param string $telefonoDocente
     */
    public function setTelefonoDocente($telefonoDocente)
    {
        $this->telefonoDocente = $telefonoDocente;
    }

    /**
     * @return int
     */
    public function getIdDocente()
    {
        return $this->idDocente;
    }

    /**
     * @param int $idDocente
     */
    public function setIdDocente($idDocente)
    {
        $this->idDocente = $idDocente;
    }

    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param Usuario $idUsuario
     */
    public function setUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public  function _toString(){
        return $this->getNombreDocente();
    }
}
