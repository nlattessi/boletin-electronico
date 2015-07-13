<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioEstablecimiento
 *
 * @ORM\Table(name="usuario_establecimiento", indexes={@ORM\Index(name="usuario_fk_establecimiento", columns={"id_usuario"}), @ORM\Index(name="establecimiento_fk_usuario", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class UsuarioEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario_establecimiento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuarioEstablecimiento;

    /**
     * @var \Acme\boletinesBundle\Entity\Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id_establecimiento")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;


    public function UsuarioEstablecimiento($usuario, $establecimiento){
        $this->setUsuario($usuario);
        $this->setEstablecimiento($establecimiento);
    }

    /**
     * @return int
     */
    public function getIdUsuarioEstablecimiento()
    {
        return $this->idUsuarioEstablecimiento;
    }

    /**
     * @param int $idUsuarioEstablecimiento
     */
    public function setIdUsuarioEstablecimiento($idUsuarioEstablecimiento)
    {
        $this->idUsuarioEstablecimiento = $idUsuarioEstablecimiento;
    }

    /**
     * @return Establecimiento
     */
    public function getEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * @param Establecimiento $idEstablecimiento
     */
    public function setEstablecimiento($idEstablecimiento)
    {
        $this->idEstablecimiento = $idEstablecimiento;
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




}
