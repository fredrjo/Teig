<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Exportschedule;
use Acme\GrabBundle\Form\ExportscheduleType;

/**
 * Exportschedule controller.
 *
 * @Route("/exportschedule")
 */
class ExportscheduleController extends Controller
{
    /**
     * Lists all Exportschedule entities.
     *
     * @Route("/", name="exportschedule_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $exportschedules = $em->getRepository('AcmeGrabBundle:Exportschedule')->findAll();

        return $this->render('exportschedule/index.html.twig', array(
            'exportschedules' => $exportschedules,
        ));
    }

    /**
     * Creates a new Exportschedule entity.
     *
     * @Route("/new", name="exportschedule_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $exportschedule = new Exportschedule();
        $form = $this->createForm('Acme\GrabBundle\Form\ExportscheduleType', $exportschedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exportschedule);
            $em->flush();

            return $this->redirectToRoute('exportschedule_show', array('id' => $exportschedule->getId()));
        }

        return $this->render('exportschedule/new.html.twig', array(
            'exportschedule' => $exportschedule,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Exportschedule entity.
     *
     * @Route("/{id}", name="exportschedule_show")
     * @Method("GET")
     */
    public function showAction(Exportschedule $exportschedule)
    {
        $deleteForm = $this->createDeleteForm($exportschedule);

        return $this->render('exportschedule/show.html.twig', array(
            'exportschedule' => $exportschedule,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Exportschedule entity.
     *
     * @Route("/{id}/edit", name="exportschedule_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Exportschedule $exportschedule)
    {
        $deleteForm = $this->createDeleteForm($exportschedule);
        $editForm = $this->createForm('Acme\GrabBundle\Form\ExportscheduleType', $exportschedule);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exportschedule);
            $em->flush();

            return $this->redirectToRoute('exportschedule_edit', array('id' => $exportschedule->getId()));
        }

        return $this->render('exportschedule/edit.html.twig', array(
            'exportschedule' => $exportschedule,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Exportschedule entity.
     *
     * @Route("/{id}", name="exportschedule_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Exportschedule $exportschedule)
    {
        $form = $this->createDeleteForm($exportschedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($exportschedule);
            $em->flush();
        }

        return $this->redirectToRoute('exportschedule_index');
    }

    /**
     * Creates a form to delete a Exportschedule entity.
     *
     * @param Exportschedule $exportschedule The Exportschedule entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Exportschedule $exportschedule)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('exportschedule_delete', array('id' => $exportschedule->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
