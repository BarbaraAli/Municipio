<?php

namespace Municipios\MuniBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Municipios\MuniBundle\Entity\Muni;
use Municipios\MuniBundle\Form\MuniType;

/**
 * Muni controller.
 *
 * @Route("/muni")
 */
class MuniController extends Controller
{
    /**
     * Lists all Muni entities.
     *
     * @Route("/", name="muni")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MunicipiosMuniBundle:Muni')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Muni entity.
     *
     * @Route("/", name="muni_create")
     * @Method("POST")
     * @Template("MunicipiosMuniBundle:Muni:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Muni();
        $form = $this->createForm(new MuniType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('muni_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Muni entity.
     *
     * @Route("/new", name="muni_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Muni();
        $form   = $this->createForm(new MuniType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Muni entity.
     *
     * @Route("/{id}", name="muni_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MunicipiosMuniBundle:Muni')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muni entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Muni entity.
     *
     * @Route("/{id}/edit", name="muni_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MunicipiosMuniBundle:Muni')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muni entity.');
        }

        $editForm = $this->createForm(new MuniType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Muni entity.
     *
     * @Route("/{id}", name="muni_update")
     * @Method("PUT")
     * @Template("MunicipiosMuniBundle:Muni:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MunicipiosMuniBundle:Muni')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muni entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MuniType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('muni_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Muni entity.
     *
     * @Route("/{id}", name="muni_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MunicipiosMuniBundle:Muni')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Muni entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('muni'));
    }

    /**
     * Creates a form to delete a Muni entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
