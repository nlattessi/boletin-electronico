<?php

namespace Acme\boletinesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\boletinesBundle\Entity\Institucion;
use Acme\boletinesBundle\Form\InstitucionType;

/**
 * Institucion controller.
 *
 * @Route("/institucion")
 */
class InstitucionController extends Controller
{

    /**
     * Lists all Institucion entities.
     *
     * @Route("/", name="institucion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoletinesBundle:Institucion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Institucion entity.
     *
     * @Route("/", name="institucion_create")
     * @Method("POST")
     * @Template("BoletinesBundle:Institucion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Institucion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('institucion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Institucion entity.
     *
     * @param Institucion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Institucion $entity)
    {
        $form = $this->createForm(new InstitucionType(), $entity, array(
            'action' => $this->generateUrl('institucion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Institucion entity.
     *
     * @Route("/new", name="institucion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Institucion();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Institucion entity.
     *
     * @Route("/{id}", name="institucion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoletinesBundle:Institucion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Institucion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Institucion entity.
     *
     * @Route("/{id}/edit", name="institucion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoletinesBundle:Institucion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Institucion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Institucion entity.
    *
    * @param Institucion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Institucion $entity)
    {
        $form = $this->createForm(new InstitucionType(), $entity, array(
            'action' => $this->generateUrl('institucion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Institucion entity.
     *
     * @Route("/{id}", name="institucion_update")
     * @Method("PUT")
     * @Template("BoletinesBundle:Institucion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoletinesBundle:Institucion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Institucion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('institucion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Institucion entity.
     *
     * @Route("/{id}", name="institucion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoletinesBundle:Institucion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Institucion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('institucion'));
    }

    /**
     * Creates a form to delete a Institucion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('institucion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
