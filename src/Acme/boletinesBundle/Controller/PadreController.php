<?php

namespace Acme\boletinesBundle\Controller;

use Acme\boletinesBundle\Entity\Padre;
//use Proxies\__CG__\Acme\boletinesBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PadreController extends Controller
{

    public function deleteDirectorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $padre = $em->getRepository('BoletinesBundle:Padre')->findOneBy(array('id' => $id));

        if($padre instanceof Padre) {
//            if($this->getUser()->getInstitucion() == $alumno->getEstablecimiento()->getInstitucion()
//            && $this->getUser()->getRol()->getName == 'ROLE_DIRECTOR') {
                $em->remove($padre);
                $em->flush();
            }
//        }
        return new RedirectResponse($this->generateUrl('directivo_padres'));
    }

}

