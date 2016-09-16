<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Importmail;
use Acme\GrabBundle\Form\ImportmailType;

/**
 * Importmail controller.
 *
 * @Route("/importmail")
 */
class ImportmailController extends Controller
{
    /**
     * Lists all Importmail entities.
     *
     * @Route("/", name="importmail_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $importmails = $em->getRepository('AcmeGrabBundle:Importmail')->findAll();

        return $this->render('importmail/index.html.twig', array(
            'importmails' => $importmails,
        ));
    }

    /**
     * Creates a new Importmail entity.
     *
     * @Route("/new", name="importmail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $importmail = new Importmail();
        $form = $this->createForm('Acme\GrabBundle\Form\ImportmailType', $importmail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($importmail);
            $em->flush();

            return $this->redirectToRoute('importmail_show', array('id' => $importmail->getId()));
        }

        return $this->render('importmail/new.html.twig', array(
            'importmail' => $importmail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Importmail entity.
     *
     * @Route("/{id}", name="importmail_show")
     * @Method("GET")
     */
    public function showAction(Importmail $importmail)
    {
        $deleteForm = $this->createDeleteForm($importmail);

        return $this->render('importmail/show.html.twig', array(
            'importmail' => $importmail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Importmail entity.
     *
     * @Route("/{id}/edit", name="importmail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Importmail $importmail)
    {
        $deleteForm = $this->createDeleteForm($importmail);
        $editForm = $this->createForm('Acme\GrabBundle\Form\ImportmailType', $importmail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($importmail);
            $em->flush();

            return $this->redirectToRoute('importmail_edit', array('id' => $importmail->getId()));
        }

        return $this->render('importmail/edit.html.twig', array(
            'importmail' => $importmail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Importmail entity.
     *
     * @Route("/{id}", name="importmail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Importmail $importmail)
    {
        $form = $this->createDeleteForm($importmail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($importmail);
            $em->flush();
        }

        return $this->redirectToRoute('importmail_index');
    }

    /**
     * Creates a form to delete a Importmail entity.
     *
     * @param Importmail $importmail The Importmail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Importmail $importmail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('importmail_delete', array('id' => $importmail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
