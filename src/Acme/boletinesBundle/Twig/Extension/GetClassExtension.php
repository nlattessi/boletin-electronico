<?php

namespace Acme\boletinesBundle\Twig\Extension;


class GetClassExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_class', [$this, 'getClass'])
        ];
    }

    public function getName()
    {
        return 'app_get_class';
    }

    public function getClass($object)
    {
        return (new \ReflectionClass($object))->getShortName();
    }
}
