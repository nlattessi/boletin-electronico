<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioGrupoUsuario
 *
 * @ORM\Table(name="usuario_grupo_usuario", indexes={@ORM\Index(name="usario_fk_grupo_usuario", columns={"id_usuario"}), @ORM\Index(name="grupo_usuario_fk_usuario", columns={"id_grupo_usuario"})})
 * @ORM\Entity
 */
class UsuarioGrupoUsuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario_grupo_usuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuarioGrupoUsuario;

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
     * @var \Acme\boletinesBundle\Entity\GrupoUsuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\GrupoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_usuario", referencedColumnName="id_grupo_usuario")
     * })
     */
    private $idGrupoUsuario;

    public function UsuarioGrupoUsuario($usuario, $grupoUsuario){
        $this->setUsuario($usuario);
        $this->setGrupoUsuario($grupoUsuario);
    }

    /**
     * @return int
     */
    public function getIdUsuarioGrupoUsuario()
    {
        return $this->idUsuarioGrupoUsuario;
    }

    /**
     * @param int $idUsuarioGrupoUsuario
     */
    public function setIdUsuarioGrupoUsuario($idUsuarioGrupoUsuario)
    {
        $this->idUsuarioGrupoUsuario = $idUsuarioGrupoUsuario;
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

    /**
     * @return GrupoUsuario
     */
    public function getGrupoUsuario()
    {
        return $this->idGrupoUsuario;
    }

    /**
     * @param GrupoUsuario $idGrupoUsuario
     */
    public function setGrupoUsuario($idGrupoUsuario)
    {
        $this->idGrupoUsuario = $idGrupoUsuario;
    }



}
