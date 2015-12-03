<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avatar
 *
 * @ORM\Table(name="avatar")
 * @ORM\Entity
 */
class Avatar
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
     * @ORM\Column(name="path", type="string", length=45, nullable=false)
     */
    private $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Avatar
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
     * Set path
     *
     * @param string $path
     * @return Avatar
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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

    public function getAbsolutePath()
    {
        return null === $this->getPath()
            ? null
            : $this->getUploadRootDir() . '/' . $this->getPath();
    }
    public function getWebPath()
    {
        return null === $this->getPath()
            ? null
            : $this->getUploadDir() . '/' . $this->getPath();
    }
    private function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }
    private function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/avatars';
    }
}
