<?php

namespace Acme\boletinesBundle\Servicios;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gaufrette\Filesystem;
use Doctrine\ORM\EntityManager;

use Acme\boletinesBundle\Entity\Archivo;
use Acme\boletinesBundle\Entity\Actividad;
use Acme\boletinesBundle\Entity\ActividadArchivo;
use Acme\boletinesBundle\Entity\Evaluacion;
use Acme\boletinesBundle\Entity\EvaluacionArchivo;
use Acme\boletinesBundle\Entity\Justificacion;
use Acme\boletinesBundle\Entity\JustificacionArchivo;
use Acme\boletinesBundle\Entity\Materia;
use Acme\boletinesBundle\Entity\MateriaArchivo;
use Acme\boletinesBundle\Entity\Mensaje;
use Acme\boletinesBundle\Entity\MensajeArchivo;


class ArchivoService
{
    private static $allowedMimeTypes = [
        'image/jpeg'
    ];

    private $filesystem;
    private $em;

    public function __construct(Filesystem $filesystem, EntityManager $entityManager)
    {
        $this->filesystem = $filesystem;
        $this->em = $entityManager;
    }

    public function createMateriaArchivo()
    {
        //Todo
    }

    public function createEvaluacionArchivo()
    {
        //Todo
    }

    public function createActividadArchivo()
    {
        //Todo
    }

    public function createJustificacionArchivo()
    {
        //Todo
    }

    public function getArchivosMateria()
    {
        //Todo
    }

    public function getArchivosEvaluacion()
    {
        //Todo
    }

    public function getArchivosActividad()
    {
        //Todo
    }

    public function getArchivosJustificacion()
    {
        //Todo
    }

    public function createMensajeArchivo(UploadedFile $file, $usuario, $mensaje)
    {
        // SETEAR SI SE QUIERE RESTRINGIR TIPOS DE ARCHIVOS A ADJUNTAR
        // if (!in_array($file->getClientMimeType(), self::$allowedMimeTypes)) {
        //     throw new \InvalidArgumentException(sprintf('Files of type %s are not allowed.', $file->getClientMimeType()));
        // }

        $filename = $this->createFile($file, "mensajes");

        $archivo = $this->newArchivo($file, $filename, $usuario);

        $mensajeArchivo = $this->newMensajeArchivo($archivo, $mensaje);

        return $mensajeArchivo;
    }

    public function getFileByFilename($filename)
    {
        $q = $this->em->getRepository("BoletinesBundle:Archivo")->createQueryBuilder('a')
            ->where('a.path LIKE :path')
            ->setParameter('path', '%' . $filename . '%');

        try {
            $archivo = $q->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            $archivo = null;
        }

        return $archivo;
    }

    public function getFileById($id)
    {
        return $this->em->getRepository("BoletinesBundle:Archivo")->find($id);
    }

    private function createFile($file, $folder)
    {
        $filename = $this->getFilename($file, $folder);

        $adapter = $this->filesystem->getAdapter();
        $adapter->write($filename, file_get_contents($file->getPathname()));

        return $filename;
    }

    private function getFilename($file, $folder)
    {
        return sprintf('%s/%s%s%s_%s.%s',
            $folder,
            date('Y'), date('m'), date('d'), uniqid(),
            $file->getClientOriginalExtension()
        );
    }

    private function newArchivo($file, $filename, $usuario)
    {
        $archivo = new Archivo();
        $archivo->setNombreParaMostrar($file->getClientOriginalName());
        $archivo->setNombre($file->getClientOriginalName());
        $archivo->setPath($filename);
        $archivo->setUsuarioCarga($usuario);
        $archivo->setFechaActualizacion(new \DateTime('now'));
        $archivo->setFechaSubida(new \DateTime('now'));

        $this->em->persist($archivo);
        $this->em->flush();

        return $archivo;
    }

    private function newMensajeArchivo($archivo, $mensaje)
    {
        $mensajeArchivo = new MensajeArchivo();
        $mensajeArchivo->setArchivo($archivo);
        $mensajeArchivo->setMensaje($mensaje);
        $mensajeArchivo->setCreationTime(new \DateTime('now'));
        $mensajeArchivo->setUpdateTime(new \DateTime('now'));

        $this->em->persist($mensajeArchivo);
        $this->em->flush();

        return $mensajeArchivo;
    }
}
