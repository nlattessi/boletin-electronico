<?php 

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mensaje")
 */
class Mensaje
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
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_recibe_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario_recibe;

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

    /**
     * @ORM\Column(type="boolean")
     */
    protected $fue_borrado;

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
     * @return Mensaje
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
     * @return Mensaje
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
     * @return Mensaje
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
     * Set fue_borrado
     *
     * @param boolean $fueBorrado
     * @return Mensaje
     */
    public function setFueBorrado($fueBorrado)
    {
        $this->fue_borrado = $fueBorrado;

        return $this;
    }

    /**
     * Get fue_borrado
     *
     * @return boolean 
     */
    public function getFueBorrado()
    {
        return $this->fue_borrado;
    }

    /**
     * Set usuario_envia
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioEnvia
     * @return Mensaje
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
     * Set usuario_recibe
     *
     * @param \Acme\boletinesBundle\Entity\Usuario $usuarioRecibe
     * @return Mensaje
     */
    public function setUsuarioRecibe(\Acme\boletinesBundle\Entity\Usuario $usuarioRecibe)
    {
        $this->usuario_recibe = $usuarioRecibe;

        return $this;
    }

    /**
     * Get usuario_recibe
     *
     * @return \Acme\boletinesBundle\Entity\Usuario 
     */
    public function getUsuarioRecibe()
    {
        return $this->usuario_recibe;
    }
}
