<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ArchivoController extends Controller
{
    public function downloadFileAction($filename)
    {
        // check if file exists in database
        $file = $this->getArchivoUploader()->getFileByFilename($filename);
        if (!$file) {
            throw $this->createNotFoundException('The file does not exist');
        }

        // check if file exists in filesystem
        $fs = new FileSystem();
        if (!$fs->exists($file->getAbsolutePath())) {
            throw $this->createNotFoundException('The file does not exist');
        }

        $response = new BinaryFileResponse($file->getAbsolutePath());
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $file->getNombre(),
            iconv('UTF-8', 'ASCII//TRANSLIT', $file->getNombre())
        );

        return $response;
    }

    public function downloadZipAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (!empty($request->request->get('files'))) {
                $files = [];

                foreach ($request->request->get('files') as $fileId) {
                    $file = $this->getArchivoUploader()->getFileById($fileId);
                    if ($file) {
                        $f = ['name' => $file->getNombre(), 'path' => $file->getAbsolutePath()];
                        array_push($files, $f);
                    }
                }

                $zip = new \ZipArchive();
                $zipName = 'Documents-'.time().".zip";
                $zip->open($this->getZipDir() . $zipName,  \ZipArchive::CREATE);
                foreach ($files as $f) {
                    $zip->addFromString(basename($f['name']),  file_get_contents($f['path']));
                }
                $zip->close();

                $response = new BinaryFileResponse($this->getZipDir() . $zipName);
                $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $zipName);

                return $response;
            } else {
                throw $this->createNotFoundException('The files do not exist');
            }
        }
    }

    private function getArchivoUploader()
    {
        return $this->get('boletines.servicios.archivo');
    }

    private function getZipDir()
    {
        return $this->get('kernel')->getRootDir() . '/../web/uploads/tmp/';
    }


}
