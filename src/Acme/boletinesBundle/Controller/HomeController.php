<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\boletinesBundle\Entity\Calendario;
use Acme\boletinesBundle\Form\UsuarioType;

class HomeController extends Controller
{

    public function fatherAction()
    {
        return $this->render('BoletinesBundle:Home:father.html.twig', array());
    }

    public function inst_manuel_belgranoAction()
    {
        return $this->render('BoletinesBundle:Home:inst_manuel_belgrano.html.twig', array());
    }

    public function inst_belgrano_day_schoolAction()
    {
        return $this->render('BoletinesBundle:Home:inst_belgrano_day_school.html.twig', array());
    }

    public function under_constructionAction()
    {
        return $this->render('BoletinesBundle:Home:under_construction.html.twig', array());
    }
}
