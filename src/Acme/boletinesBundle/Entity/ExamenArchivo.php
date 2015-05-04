<?php

namespace Acme\boletinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExamenArchivo
 *
 * @ORM\Table(name="examen_archivo", indexes={@ORM\Index(name="examen_fk_archivo", columns={"id_examen"}), @ORM\Index(name="archivo_fk_examen", columns={"id_archivo"})})
 * @ORM\Entity
 */
class ExamenArchivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_examen_archivo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExamenArchivo;

    /**
     * @var \Acme\boletinesBundle\Entity\Examen
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Examen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_examen", referencedColumnName="id_examen")
     * })
     */
    private $idExamen;

    /**
     * @var \Acme\boletinesBundle\Entity\Archivo
     *
     * @ORM\ManyToOne(targetEntity="Acme\boletinesBundle\Entity\Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_archivo", referencedColumnName="id_archivo")
     * })
     */
    private $idArchivo;


}
