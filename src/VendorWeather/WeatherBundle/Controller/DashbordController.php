<?php

namespace VendorWeather\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use VendorWeather\WeatherBundle\Entity\Region;

class DashbordController extends Controller
{
    /**
     * @Route("/admin", name="Dashbord")
     */
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
  //      $region = $this->$em()->findall();
  $allregions = $this->getDoctrine()->getRepository('WeatherBundle:Region')->findAll();
  return $this->render('WeatherBundle:Dashbord:index.html.twig',array(
  'regions'=>$allregions)
  );   
}
public function editAction ()
{
    return $this->render('WeatherBundle:Dashbord:edit-region.html.twig');
}


}