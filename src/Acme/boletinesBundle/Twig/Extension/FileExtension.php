<?php

namespace Acme\boletinesBundle\Twig\Extension;


class FileExtension extends \Twig_Extension
{

    /**
     * Return the functions registered as twig extensions
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('file_exists', 'file_exists'),
        ];
    }

    public function getName()
    {
        return 'app_file';
    }
}
