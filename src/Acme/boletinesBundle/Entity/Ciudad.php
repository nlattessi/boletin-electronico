<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ciudad
 *
 * @ORM\Table(name="ciudad", indexes={@ORM\Index(name="FK_provincida_id", columns={"provincia_id"})})
 * @ORM\Entity
 */
class Ciudad
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\boletinesBundle\Entity\Provincia
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     * })
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity="Establecimiento", mappedBy="ciudad")
     */
    protected $establecimientos;


    public function __construct()
    {
        $this->establecimientos = new ArrayCollection();
    }



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Ciudad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
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
     * Set provincia
     *
     * @param \Acme\boletinesBundle\Entity\Provincia $provincia
     * @return Ciudad
     */
    public function setProvincia(\Acme\boletinesBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Acme\boletinesBundle\Entity\Provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Add establecimientos
     *
     * @param \Acme\boletinesBundle\Entity\Establecimiento $establecimientos
     * @return Ciudad
     */
    public function addEstablecimiento(\Acme\boletinesBundle\Entity\Establecimiento $establecimientos)
    {
        $this->establecimientos[] = $establecimientos;

        return $this;
    }

    /**
     * Remove establecimientos
     *
     * @param \Acme\boletinesBundle\Entity\Establecimiento $establecimientos
     */
    public function removeEstablecimiento(\Acme\boletinesBundle\Entity\Establecimiento $establecimientos)
    {
        $this->establecimientos->removeElement($establecimientos);
    }

    /**
     * Get establecimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstablecimientos()
    {
        return $this->establecimientos;
    }
}
