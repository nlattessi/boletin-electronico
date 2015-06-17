<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="notificacion")
 */
class Notificacion
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_envia_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario_envia;

    /**
     * @ORM\ManyToOne(targetEntity="GrupoUsuario")
     * @ORM\JoinColumn(name="grupo_recibe_id", referencedColumnName="id", nullable=false)
     */
    protected $grupo_recibe;

    /**
     * @ORM\Column(type="string")
     */
    protected $titulo;

    /**
     * @ORM\Column(type="text")
     */
    protected $texto;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_envio;

    public function __construct()
    {
        $this->fecha_envio = new \DateTime();
    }

    public function __toString()
    {
        return $this->getTitulo();
    }

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
     * Set titulo
     *
     * @param string $titulo
     * @return Notificacion
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Notificacion
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set fecha_envio
     *
     * @param \DateTime $fechaEnvio
     * @return Notificacion
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fecha_envio = $fechaEnvio;

        return $this;
    }

    /**
     * Get fecha_envio
     *
     * @return \DateTime 
     */
    public function getFechaEnvio()
    {
        return $this->fecha_envio;
    }

    /**
     * Set usuario_envia
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioEnvia
     * @return Notificacion
     */
    public function setUsuarioEnvia(\Acme\boletinesBundle\Entity\Usuario $usuarioEnvia)
    {
        $this->usuario_envia = $usuarioEnvia;

        return $this;
    }

    /**
     * Get usuario_envia
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuarioEnvia()
    {
        return $this->usuario_envia;
    }

    /**
     * Set grupo_recibe
     *
     * @param \Acme\boletinesBundle\Entity\GrupoUsuario $grupoRecibe
     * @return Notificacion
     */
    public function setGrupoRecibe(\Acme\boletinesBundle\Entity\GrupoUsuario $grupoRecibe)
    {
        $this->grupo_recibe = $grupoRecibe;

        return $this;
    }

    /**
     * Get grupo_recibe
     *
     * @return \Acme\boletinesBundle\Entity\GrupoUsuario 
     */
    public function getGrupoRecibe()
    {
        return $this->grupo_recibe;
    }
}
