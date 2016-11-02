<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\GrabBundle\Entity\Grabber;
use Acme\GrabBundle\Form\GrabberType;

/**
 * Grabber controller.
 *
 * @Route("/grabber")
 */
class GrabberController extends Controller
{
    /**
     * Lists all Grabber entities.
     *
     * @Route("/", name="grabber_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grabbers = $em->getRepository('AcmeGrabBundle:Grabber')->findAll();

        return $this->render('grabber/index.html.twig', array(
            'grabbers' => $grabbers,
        ));
    }

    /**
     * Creates a new Grabber entity.
     *
     * @Route("/new", name="grabber_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $grabber = new Grabber();
        $form = $this->createForm('Acme\GrabBundle\Form\GrabberType', $grabber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabber);
            $em->flush();

            return $this->redirectToRoute('grabber_show', array('id' => $grabber->getId()));
        }

        return $this->render('grabber/new.html.twig', array(
            'grabber' => $grabber,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Grabber entity.
     *
     * @Route("/{id}", name="grabber_show")
     * @Method("GET")
     */
    public function showAction(Grabber $grabber)
    {
        $meters=array();
        $lastAction=array();
        $somedata=$this->getWebAdress($grabber->getName());
        $em = $this->getDoctrine()->getManager();
        $exportschdules = $em->getRepository('AcmeGrabBundle:Exportschedule')->findBy(array("grabber"=>$grabber->getId()));
        foreach ($exportschdules as $exp) {
          $meters[]=$em->getRepository('AcmeGrabBundle:Meter')->findBy(array('exportschedule'=>$exp->getId()));
        }
        $rows=array();
        foreach ($meters as $meter) {
          $conn = $this->container->get('database_connection');
          $sql = "SELECT meter_id,max(metertime) as max FROM meterdata GROUP BY meter_id";
          $rows=$conn->query($sql);
        }
        while ($result=$rows->fetch()) {
          $lastAction[$result['meter_id']]=$result['max'];
        }
        $deleteForm = $this->createDeleteForm($grabber);
        return $this->render('grabber/show.html.twig', array(
            'grabber' => $grabber,
            'metersArray' => $meters,
            'lastAction' => $lastAction,
            'delete_form' => $deleteForm->createView(),
            'data' => $somedata,
        ));

    }

    /**
     * Displays a form to edit an existing Grabber entity.
     *
     * @Route("/{id}/edit", name="grabber_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Grabber $grabber)
    {
        $deleteForm = $this->createDeleteForm($grabber);
        $editForm = $this->createForm('Acme\GrabBundle\Form\GrabberType', $grabber);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grabber);
            $em->flush();

            return $this->redirectToRoute('grabber_edit', array('id' => $grabber->getId()));
        }

        return $this->render('grabber/edit.html.twig', array(
            'grabber' => $grabber,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    private function getWebAdress($grabberName) {
        $filename='/home/fredrik/development/TEIG/grab/grabbers/grabs.py';
        $file=fopen($filename,"r");
        $grabberclass="";
        $data=explode('class',fread($file,filesize($filename)));
        fclose($file);
        foreach($data as $grabber) {
            if (stripos($grabberName, $grabber) == 0) {
                $grabberclass=explode('\'',$grabber);
            };
        }

        return $grabberclass[1].$grabberclass[3];

    }

    /**
     * Deletes a Grabber entity.
     *
     * @Route("/{id}", name="grabber_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Grabber $grabber)
    {
        $form = $this->createDeleteForm($grabber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grabber);
            $em->flush();
        }

        return $this->redirectToRoute('grabber_index');
    }

    /**
     * Creates a form to delete a Grabber entity.
     *
     * @param Grabber $grabber The Grabber entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Grabber $grabber)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grabber_delete', array('id' => $grabber->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
