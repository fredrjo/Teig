<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Logindata;
use Acme\GrabBundle\Form\LogindataType;

/**
 * Logindata controller.
 *
 * @Route("/logindata")
 */
class LogindataController extends Controller
{
    /**
     * Lists all Logindata entities.
     *
     * @Route("/", name="logindata_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logindatas = $em->getRepository('AcmeGrabBundle:Logindata')->findAll();

        return $this->render('logindata/index.html.twig', array(
            'logindatas' => $logindatas,
        ));
    }

    /**
     * Creates a new Logindata entity.
     *
     * @Route("/new", name="logindata_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $logindatum = new Logindata();
        $form = $this->createForm('Acme\GrabBundle\Form\LogindataType', $logindatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($logindatum);
            $em->flush();

            return $this->redirectToRoute('logindata_show', array('id' => $logindatum->getId()));
        }

        return $this->render('logindata/new.html.twig', array(
            'logindatum' => $logindatum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Logindata entity.
     *
     * @Route("/{id}", name="logindata_show")
     * @Method("GET")
     */
    public function showAction(Logindata $logindatum)
    {
        $deleteForm = $this->createDeleteForm($logindatum);

        return $this->render('logindata/show.html.twig', array(
            'logindatum' => $logindatum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Logindata entity.
     *
     * @Route("/{id}/edit", name="logindata_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Logindata $logindatum)
    {
        $deleteForm = $this->createDeleteForm($logindatum);
        $editForm = $this->createForm('Acme\GrabBundle\Form\LogindataType', $logindatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($logindatum);
            $em->flush();

            return $this->redirectToRoute('logindata_edit', array('id' => $logindatum->getId()));
        }

        return $this->render('logindata/edit.html.twig', array(
            'logindatum' => $logindatum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Logindata entity.
     *
     * @Route("/{id}", name="logindata_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Logindata $logindatum)
    {
        $form = $this->createDeleteForm($logindatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($logindatum);
            $em->flush();
        }

        return $this->redirectToRoute('logindata_index');
    }

    /**
     * Creates a form to delete a Logindata entity.
     *
     * @param Logindata $logindatum The Logindata entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Logindata $logindatum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('logindata_delete', array('id' => $logindatum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
