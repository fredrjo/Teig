<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Grabdata;
use Acme\GrabBundle\Form\GrabdataType;

/**
 * Grabdata controller.
 *
 * @Route("/grabdata")
 */
class GrabdataController extends Controller
{
    /**
     * Lists all Grabdata entities.
     *
     * @Route("/", name="grabdata_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grabdatas = $em->getRepository('AcmeGrabBundle:Grabdata')->findAll();

        return $this->render('grabdata/index.html.twig', array(
            'grabdatas' => $grabdatas,
        ));
    }

    /**
     * Creates a new Grabdata entity.
     *
     * @Route("/new", name="grabdata_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $grabdatum = new Grabdata();
        $form = $this->createForm('Acme\GrabBundle\Form\GrabdataType', $grabdatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabdatum);
            $em->flush();

            return $this->redirectToRoute('grabdata_show', array('id' => $grabdatum->getId()));
        }

        return $this->render('grabdata/new.html.twig', array(
            'grabdatum' => $grabdatum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Grabdata entity.
     *
     * @Route("/{id}", name="grabdata_show")
     * @Method("GET")
     */
    public function showAction(Grabdata $grabdatum)
    {
        $deleteForm = $this->createDeleteForm($grabdatum);

        return $this->render('grabdata/show.html.twig', array(
            'grabdatum' => $grabdatum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Grabdata entity.
     *
     * @Route("/{id}/edit", name="grabdata_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Grabdata $grabdatum)
    {
        $deleteForm = $this->createDeleteForm($grabdatum);
        $editForm = $this->createForm('Acme\GrabBundle\Form\GrabdataType', $grabdatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabdatum);
            $em->flush();

            return $this->redirectToRoute('grabdata_edit', array('id' => $grabdatum->getId()));
        }

        return $this->render('grabdata/edit.html.twig', array(
            'grabdatum' => $grabdatum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Grabdata entity.
     *
     * @Route("/{id}", name="grabdata_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Grabdata $grabdatum)
    {
        $form = $this->createDeleteForm($grabdatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grabdatum);
            $em->flush();
        }

        return $this->redirectToRoute('grabdata_index');
    }

    /**
     * Creates a form to delete a Grabdata entity.
     *
     * @param Grabdata $grabdatum The Grabdata entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Grabdata $grabdatum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grabdata_delete', array('id' => $grabdatum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
