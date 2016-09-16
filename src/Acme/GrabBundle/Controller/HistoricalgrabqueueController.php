<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Historicalgrabqueue;
use Acme\GrabBundle\Form\HistoricalgrabqueueType;

/**
 * Historicalgrabqueue controller.
 *
 * @Route("/historicalgrabqueue")
 */
class HistoricalgrabqueueController extends Controller
{
    /**
     * Lists all Historicalgrabqueue entities.
     *
     * @Route("/", name="historicalgrabqueue_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $historicalgrabqueues = $em->getRepository('AcmeGrabBundle:Historicalgrabqueue')->findAll();

        return $this->render('historicalgrabqueue/index.html.twig', array(
            'historicalgrabqueues' => $historicalgrabqueues,
        ));
    }

    /**
     * Creates a new Historicalgrabqueue entity.
     *
     * @Route("/new", name="historicalgrabqueue_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $historicalgrabqueue = new Historicalgrabqueue();
        $form = $this->createForm('Acme\GrabBundle\Form\HistoricalgrabqueueType', $historicalgrabqueue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($historicalgrabqueue);
            $em->flush();

            return $this->redirectToRoute('historicalgrabqueue_show', array('id' => $historicalgrabqueue->getId()));
        }

        return $this->render('historicalgrabqueue/new.html.twig', array(
            'historicalgrabqueue' => $historicalgrabqueue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Historicalgrabqueue entity.
     *
     * @Route("/{id}", name="historicalgrabqueue_show")
     * @Method("GET")
     */
    public function showAction(Historicalgrabqueue $historicalgrabqueue)
    {
        $deleteForm = $this->createDeleteForm($historicalgrabqueue);

        return $this->render('historicalgrabqueue/show.html.twig', array(
            'historicalgrabqueue' => $historicalgrabqueue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Historicalgrabqueue entity.
     *
     * @Route("/{id}/edit", name="historicalgrabqueue_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Historicalgrabqueue $historicalgrabqueue)
    {
        $deleteForm = $this->createDeleteForm($historicalgrabqueue);
        $editForm = $this->createForm('Acme\GrabBundle\Form\HistoricalgrabqueueType', $historicalgrabqueue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($historicalgrabqueue);
            $em->flush();

            return $this->redirectToRoute('historicalgrabqueue_edit', array('id' => $historicalgrabqueue->getId()));
        }

        return $this->render('historicalgrabqueue/edit.html.twig', array(
            'historicalgrabqueue' => $historicalgrabqueue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Historicalgrabqueue entity.
     *
     * @Route("/{id}", name="historicalgrabqueue_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Historicalgrabqueue $historicalgrabqueue)
    {
        $form = $this->createDeleteForm($historicalgrabqueue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($historicalgrabqueue);
            $em->flush();
        }

        return $this->redirectToRoute('historicalgrabqueue_index');
    }

    /**
     * Creates a form to delete a Historicalgrabqueue entity.
     *
     * @param Historicalgrabqueue $historicalgrabqueue The Historicalgrabqueue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Historicalgrabqueue $historicalgrabqueue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('historicalgrabqueue_delete', array('id' => $historicalgrabqueue->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
