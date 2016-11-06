<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Meter;
use Acme\GrabBundle\Form\MeterType;

/**
 * Meter controller.
 *
 * @Route("/meter")
 */
class MeterController extends Controller
{
    /**
     * Lists all Meter entities.
     *
     * @Route("/", name="meter_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $meters = $em->getRepository('AcmeGrabBundle:Meter')->findAll();

        return $this->render('meter/index.html.twig', array(
            'meters' => $meters,
        ));
    }
    /**
     * Status of all Meter entities.
     *
     * @Route("/status", name="meter_status")
     * @Method("GET")
     */
    public function statusAction()
    {
        $lastAction=array();
        $em = $this->getDoctrine()->getManager();

        $meters = $em->getRepository('AcmeGrabBundle:Meter')->findAll();
        foreach ($meters as $meter) {
          $conn = $this->container->get('database_connection');
          $sql = "SELECT meter_id,max(metertime) as max FROM meterdata GROUP BY meter_id";
          $rows=$conn->query($sql);
        }
        while ($result=$rows->fetch()) {
          $lastAction[$result['meter_id']]=$result['max'];
        }

        return $this->render('meter/status.html.twig', array(
            'meters' => $meters,
            'lastAction' =>$lastAction
        ));
    }

    /**
     * Creates a new Meter entity.
     *
     * @Route("/new", name="meter_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $meter = new Meter();
        $form = $this->createForm('Acme\GrabBundle\Form\MeterType', $meter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meter);
            $em->flush();

            return $this->redirectToRoute('meter_show', array('id' => $meter->getId()));
        }

        return $this->render('meter/new.html.twig', array(
            'meter' => $meter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Meter entity.
     *
     * @Route("/{id}", name="meter_show")
     * @Method("GET")
     */
    public function showAction(Meter $meter)
    {
        $deleteForm = $this->createDeleteForm($meter);

        return $this->render('meter/show.html.twig', array(
            'meter' => $meter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Meter entity.
     *
     * @Route("/{id}/edit", name="meter_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Meter $meter)
    {
        $deleteForm = $this->createDeleteForm($meter);
        $editForm = $this->createForm('Acme\GrabBundle\Form\MeterType', $meter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meter);
            $em->flush();

            return $this->redirectToRoute('meter_edit', array('id' => $meter->getId()));
        }

        return $this->render('meter/edit.html.twig', array(
            'meter' => $meter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Meter entity.
     *
     * @Route("/{id}", name="meter_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Meter $meter)
    {
        $form = $this->createDeleteForm($meter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($meter);
            $em->flush();
        }

        return $this->redirectToRoute('meter_index');
    }

    /**
     * Creates a form to delete a Meter entity.
     *
     * @param Meter $meter The Meter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Meter $meter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meter_delete', array('id' => $meter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Grabs data from an existing Meter entity.
     *
     * @Route("/{id}/grab", name="meter_grab")
     * @Method({"GET", "POST"})
     */
    public function grabAction(Request $request, Meter $meter)
    {
      $result=$this->execInBackground('python c:/wamp/spesific_grab.py aga 2366576');

        return $this->redirectToRoute('meter_index');
    }
    private function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}
}
