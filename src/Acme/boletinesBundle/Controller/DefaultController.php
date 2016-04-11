<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
//        return $this->render('BoletinesBundle:Default:index.html.twig', array('name' => $name));
    }
    public function enConstruccionAction()
    {
        return $this->render('BoletinesBundle:Default:en_construccion.html.twig');
    }

    public function unauthorizedAction()
    {
        return $this->render('BoletinesBundle:Default:unauthorized.html.twig');
    }
}
