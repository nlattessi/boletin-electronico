<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="nombre_institucion", type="string", length=45, nullable=false)
     */
    private $nombreInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_institucion", type="string", length=45, nullable=false)
     */
    private $direccionInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_institucion", type="string", length=45, nullable=true)
     */
    private $telefonoInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="email_institucion", type="string", length=45, nullable=true)
     */
    private $emailInstitucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_institucion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInstitucion;


}
