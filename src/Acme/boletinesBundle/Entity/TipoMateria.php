<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoMateria
 *
 * @ORM\Table(name="tipo_materia")
 * @ORM\Entity
 */
class TipoMateria
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tipo_materia", type="string", length=45, nullable=false)
     */
    private $nombreTipoMateria;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_materia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoMateria;


}
