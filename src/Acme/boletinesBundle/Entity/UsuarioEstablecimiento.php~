<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioEstablecimiento
 *
 * @ORM\Table(name="usuario_establecimiento", indexes={@ORM\Index(name="FK_7110F23F7DFA12F6", columns={"establecimiento_id"}), @ORM\Index(name="FK_7110F23FFCF8192D", columns={"usuario_id"})})
 * @ORM\Entity
 */
class UsuarioEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \Acme\boletinesBundle\Entity\Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="establecimiento_id", referencedColumnName="id")
     * })
     */
    private $establecimiento;



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
     * @return UsuarioEstablecimiento
     */
    public function setUsuario(\Acme\boletinesBundle\Entity\Usuario $usuario = null)
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
     * Set establecimiento
     *
     * @param \Acme\boletinesBundle\Entity\Establecimiento $establecimiento
     * @return UsuarioEstablecimiento
     */
    public function setEstablecimiento(\Acme\boletinesBundle\Entity\Establecimiento $establecimiento = null)
    {
        $this->establecimiento = $establecimiento;

        return $this;
    }

    /**
     * Get establecimiento
     *
     * @return \Acme\boletinesBundle\Entity\Establecimiento 
     */
    public function getEstablecimiento()
    {
        return $this->establecimiento;
    }
}
