<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HistoricController extends Controller
{

    public function onAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $session->set('historic', 'on');

        return new RedirectResponse($this->generateUrl('home'));
    }

    public function offAction()
    {
      $request = $this->getRequest();
      $session = $request->getSession();
      $year = date('Y');
      $start = mktime(0, 0, 0, 1, 1, $year);
      $end = mktime(0, 0, 0, 12, 31, $year);
      $session->set('year', date('Y', $start));
      $session->set('startYear', date('Y-m-d H:i:s', $start));
      $session->set('endYear', date('Y-m-d H:i:s', $end));
      $session->set('historic', 'off');

      return new RedirectResponse($this->generateUrl('home'));
    }

    public function downYearAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $year = $session->get('year') - 1;
        $session->set('year', $year);
        $start = mktime(0, 0, 0, 1, 1, $year);
        $end = mktime(0, 0, 0, 12, 31, $year);
        $session->set('startYear', date('Y-m-d H:i:s', $start));
        $session->set('endYear', date('Y-m-d H:i:s', $end));

        return new RedirectResponse($this->generateUrl('home'));
    }

    public function upYearAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $year = $session->get('year') + 1;
        $session->set('year', $year);
        $start = mktime(0, 0, 0, 1, 1, $year);
        $end = mktime(0, 0, 0, 12, 31, $year);
        $session->set('startYear', date('Y-m-d H:i:s', $start));
        $session->set('endYear', date('Y-m-d H:i:s', $end));

        return new RedirectResponse($this->generateUrl('home'));
    }
}
