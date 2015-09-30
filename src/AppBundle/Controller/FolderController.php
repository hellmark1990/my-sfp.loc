<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Folder;
use AppBundle\Form\FolderType;

/**
 * Folder controller.
 *
 * @Route("/folder")
 */
class FolderController extends Controller
{

    /**
     * Lists all Folder entities.
     *
     * @Route("/", name="folder")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Folder')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Folder entity.
     *
     * @Route("/", name="folder_create")
     * @Method("POST")
     * @Template("AppBundle:Folder:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Folder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('folder_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Folder entity.
     *
     * @param Folder $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Folder $entity)
    {
        $form = $this->createForm(new FolderType(), $entity, array(
            'action' => $this->generateUrl('folder_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Folder entity.
     *
     * @Route("/new", name="folder_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Folder();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Folder entity.
     *
     * @Route("/{id}", name="folder_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var Folder $entity
         */
        $entity = $em->getRepository('AppBundle:Folder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Folder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Folder entity.
     *
     * @Route("/{id}/edit", name="folder_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Folder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Folder entity.');
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
    * Creates a form to edit a Folder entity.
    *
    * @param Folder $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Folder $entity)
    {
        $form = $this->createForm(new FolderType(), $entity, array(
            'action' => $this->generateUrl('folder_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Folder entity.
     *
     * @Route("/{id}", name="folder_update")
     * @Method("PUT")
     * @Template("AppBundle:Folder:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Folder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Folder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('folder_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Folder entity.
     *
     * @Route("/{id}", name="folder_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Folder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Folder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('folder'));
    }

    /**
     * Creates a form to delete a Folder entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('folder_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
