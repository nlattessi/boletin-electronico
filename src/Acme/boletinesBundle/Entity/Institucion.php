<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Institucion
 *
 * @ORM\Table(name="institucion")
 * @ORM\Entity
 */
class Institucion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=45, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="cuit", type="string", length=11, nullable=true)
     */
    private $cuit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime", nullable=true)
     */
    private $creationTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Establecimiento", mappedBy="institucion", cascade={"remove"})
     */
    protected $establecimientos;

    /**
     * @var boolean
     */
    private $activo = true;


    public function __construct()
    {
        $this->creationTime = new \DateTime();
        $this->establecimientos = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
    }

    public function addEstablecimiento(Establecimiento $e)
    {
        $this->establecimientos[] = $e;
        $e->setInstitucion($this);

        return $this;
    }

    public function getEstablecimientos()
    {
        return $this->establecimientos;
    }


    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="institucion", cascade={"remove"})
     */
    protected $usuarios;

    public function addUsuario(Usuario $u)
    {
        $this->usuarios[] = $u;
        $u->setInstitucion($this);

        return $this;
    }

    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Institucion
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
     * Set logo
     *
     * @param string $logo
     * @return Institucion
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set cuit
     *
     * @param string $cuit
     * @return Institucion
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     * @return Institucion
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return \DateTime
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Institucion
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
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
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    public function getAbsolutePath()
    {
        return null === $this->getLogo()
            ? null
            : $this->getUploadRootDir() . '/' . $this->getLogo();
    }
    public function getWebPath()
    {
        return null === $this->getLogo()
            ? null
            : $this->getUploadDir() . '/' . $this->getLogo();
    }
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'bundles/boletines/uploads/logos';
    }

    /**
     * @return boolean
     */
    public function isActivo()
    {
        return $this->activo;
    }

    /**
     * @param boolean $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }


}
