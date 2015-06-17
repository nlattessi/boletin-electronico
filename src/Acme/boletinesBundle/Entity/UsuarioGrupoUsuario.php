<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario_grupo_usuario")
 */
class UsuarioGrupoUsuario
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="GrupoUsuario")
     * @ORM\JoinColumn(name="grupo_usuario_id", referencedColumnName="id", nullable=false)
     */
    protected $grupo_usuario;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set usuario
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuario
     * @return UsuarioGrupoUsuario
     */
    public function setUsuario(\Acme\boletinesBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set grupo_usuario
     *
     * @param \Acme\boletinesBundle\Entity\GrupoUsuario $grupoUsuario
     * @return UsuarioGrupoUsuario
     */
    public function setGrupoUsuario(\Acme\boletinesBundle\Entity\GrupoUsuario $grupoUsuario)
    {
        $this->grupo_usuario = $grupoUsuario;

        return $this;
    }

    /**
     * Get grupo_usuario
     *
     * @return \Acme\boletinesBundle\Entity\GrupoUsuario 
     */
    public function getGrupoUsuario()
    {
        return $this->grupo_usuario;
    }
}
