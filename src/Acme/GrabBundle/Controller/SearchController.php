<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SearchController extends Controller
{
    /**
     * @Route("/search_result")
     */
    public function resultAction(Request $request)
    {
      var_dump($_GET);die;
        return $this->render('search/result.html.twig', array(
            // ...
        ));
    }
    /**
     * Finds and displays a Grabber entity.
     *
     * @Route("/{key}", name="search_show")
     * @Method("POST")
     */
    public function showAction(Request $request)
    {
      $importId=$_POST['search'];
      $em = $this->getDoctrine()->getManager();
      $meterId = $em->getRepository('AcmeGrabBundle:Meter')->findBy(array('importId'=>$importId));
      if (isset($meterId[0])) {
        return $this->redirectToRoute('meter_show', array('id' => $meterId[0]->getId()));
      }
      else {
        return $this->redirect($request->server->get('HTTP_REFERER'));
      }

    }

}
