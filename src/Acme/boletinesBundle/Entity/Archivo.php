<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archivo
 *
 * @ORM\Table(name="archivo", indexes={@ORM\Index(name="usuario_fk_archivo", columns={"id_usuario_carga"})})
 * @ORM\Entity
 */
class Archivo
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_para_mostrar", type="string", length=45, nullable=false)
     */
    private $nombreParaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_archivo", type="string", length=45, nullable=false)
     */
    private $nombreArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_archivo", type="string", length=75, nullable=false)
     */
    private $rutaArchivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_subida", type="datetime", nullable=false)
     */
    private $fechaSubida;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_archivo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArchivo;

    /**
     * @var \Acme\boletinesBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_carga", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuarioCarga;


}
