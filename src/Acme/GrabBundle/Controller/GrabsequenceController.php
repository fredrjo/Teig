<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Grabsequence;
use Acme\GrabBundle\Form\GrabsequenceType;

/**
 * Grabsequence controller.
 *
 * @Route("/grabsequence")
 */
class GrabsequenceController extends Controller
{
    /**
     * Lists all Grabsequence entities.
     *
     * @Route("/", name="grabsequence_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $grabbers=array();
        $maxtime=array();
        $status=array();
        $em = $this->getDoctrine()->getManager();

        $grabsequences = $em->getRepository('AcmeGrabBundle:Grabsequence')->findAll();
        foreach($grabsequences as $grabsequence) {
          if (!(in_array($grabsequence->getGrabber()->getName(),$grabbers))) {
            $grabbers[]=$grabsequence->getGrabber()->getName();
          }
          if (in_array($grabsequence->getGrabber()->getName(),$grabbers)) {
              foreach($grabbers as $grabber) {
                if ($grabber==$grabsequence->getGrabber()) {
                  $maxtime[$grabsequence->getGrabber()->getName()]=$grabsequence->getGrabtime();
                  $status[$grabsequence->getGrabber()->getName()]=$grabsequence->getStatus();
                }
              }
          }
        }


        return $this->render('grabsequence/index.html.twig', array(
            'last' => $maxtime,
            'grabbers' => $grabbers,
            'status' => $status,
        ));
    }

    /**
     * Creates a new Grabsequence entity.
     *
     * @Route("/new", name="grabsequence_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $grabsequence = new Grabsequence();
        $form = $this->createForm('Acme\GrabBundle\Form\GrabsequenceType', $grabsequence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabsequence);
            $em->flush();

            return $this->redirectToRoute('grabsequence_show', array('id' => $grabsequence->getId()));
        }

        return $this->render('grabsequence/new.html.twig', array(
            'grabsequence' => $grabsequence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Grabsequence entity.
     *
     * @Route("/{id}", name="grabsequence_show")
     * @Method("GET")
     */
    public function showAction(Grabsequence $grabsequence)
    {
        $deleteForm = $this->createDeleteForm($grabsequence);

        return $this->render('grabsequence/show.html.twig', array(
            'grabsequence' => $grabsequence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Grabsequence entity.
     *
     * @Route("/{id}/edit", name="grabsequence_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Grabsequence $grabsequence)
    {
        $deleteForm = $this->createDeleteForm($grabsequence);
        $editForm = $this->createForm('Acme\GrabBundle\Form\GrabsequenceType', $grabsequence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabsequence);
            $em->flush();

            return $this->redirectToRoute('grabsequence_edit', array('id' => $grabsequence->getId()));
        }

        return $this->render('grabsequence/edit.html.twig', array(
            'grabsequence' => $grabsequence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Grabsequence entity.
     *
     * @Route("/{id}", name="grabsequence_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Grabsequence $grabsequence)
    {
        $form = $this->createDeleteForm($grabsequence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grabsequence);
            $em->flush();
        }

        return $this->redirectToRoute('grabsequence_index');
    }

    /**
     * Creates a form to delete a Grabsequence entity.
     *
     * @param Grabsequence $grabsequence The Grabsequence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Grabsequence $grabsequence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grabsequence_delete', array('id' => $grabsequence->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
