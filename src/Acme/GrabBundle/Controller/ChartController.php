<?php

namespace Acme\GrabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Khill\Lavacharts\Lavacharts;

/**
 * Chart controller.
 *
 * @Route("/chart")
 */
 class ChartController extends Controller
 {
     /**
      * Lists all Alarm entities.
      *
      * @Route("/", name="chart_index")
      * @Method("GET")
      */
     public function indexAction()
     {
       $charts=null;
       return $this->render('chart/index.html.twig', array(
           'chart' => $charts,
       ));
     }
     /**
      * Lists all Alarm entities.
      *
      * @Route("/meterdata", name="chart_meterdata")
      * @Method("GET")
      */
     public function meterdataAction()
     {
       $meterId=$this->getRequest()->query->get('meterId');
       $datafromDB=$this->getDataTable($meterId);
       $lava = new Lavacharts; // See note below for Laravel

       $usage = $lava->DataTable();

       $usage->addDateColumn('Day')
           ->addNumberColumn('Usage kW/h');
        foreach($datafromDB as $measurement) {
          $usage->addRow($measurement);

        }

           $lava->LineChart('EnergyUsage', $usage, [
             'title' => 'Energy Usage for meter',
             'legend' => [
               'position' => 'in'
             ]
           ]);
       return $this->render('chart/meterdata.html.twig', array(
           'lava' => $lava,
       ));
     }
     private function getDataTable($meterId) {
       $dataTable=array();
       $conn = $this->container->get('database_connection');
       $sql = "SELECT metertime,metervalue FROM meterdata WHERE meter_id='".$meterId."'";
       $rows=$conn->query($sql);
       while ($result=$rows->fetch()) {
         $dataTable[]=[$result['metertime'],intval($result['metervalue'])];
       }
       return $dataTable;
     }
   }
