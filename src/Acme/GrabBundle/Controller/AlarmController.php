<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Alarm;
use Acme\GrabBundle\Form\AlarmType;

/**
 * Alarm controller.
 *
 * @Route("/alarm")
 */
class AlarmController extends Controller
{
    /**
     * Lists all Alarm entities.
     *
     * @Route("/", name="alarm_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('AcmeGrabBundle:Alarm');
        $query = $repository->createQueryBuilder('a')
          ->setMaxResults(50)
          ->orderBy('a.id', 'DESC')
          ->getQuery();

        $alarms = $query->getResult();
        return $this->render('alarm/index.html.twig', array(
            'alarms' => $alarms,
        ));
    }

    /**
     * Creates a new Alarm entity.
     *
     * @Route("/new", name="alarm_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $alarm = new Alarm();
        $form = $this->createForm(new AlarmType(), $alarm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alarm);
            $em->flush();

            return $this->redirectToRoute('alarm_show', array('id' => $alarm->getId()));
        }

        return $this->render('alarm/new.html.twig', array(
            'alarm' => $alarm,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Alarm entity.
     *
     * @Route("/{id}", name="alarm_show")
     * @Method("GET")
     */
    public function showAction(Alarm $alarm)
    {
        $deleteForm = $this->createDeleteForm($alarm);

        return $this->render('alarm/show.html.twig', array(
            'alarm' => $alarm,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Alarm entity.
     *
     * @Route("/{id}/edit", name="alarm_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Alarm $alarm)
    {
        $deleteForm = $this->createDeleteForm($alarm);
        $editForm = $this->createForm(new AlarmType(), $alarm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alarm);
            $em->flush();

            return $this->redirectToRoute('alarm_edit', array('id' => $alarm->getId()));
        }

        return $this->render('alarm/edit.html.twig', array(
            'alarm' => $alarm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Alarm entity.
     *
     * @Route("/{id}", name="alarm_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Alarm $alarm)
    {
        $form = $this->createDeleteForm($alarm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alarm);
            $em->flush();
        }

        return $this->redirectToRoute('alarm_index');
    }

    /**
     * Creates a form to delete a Alarm entity.
     *
     * @param Alarm $alarm The Alarm entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Alarm $alarm)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alarm_delete', array('id' => $alarm->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
