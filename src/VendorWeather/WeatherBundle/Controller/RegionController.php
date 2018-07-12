<?php

namespace VendorWeather\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use VendorWeather\WeatherBundle\Entity\Region;
use VendorWeather\WeatherBundle\Form\RegionType;

class RegionController extends Controller
{
       public function editAction (Request $request, region $region)
{
    /* return $this->render('WeatherBundle:Dashbord:edit-region.html.twig');*/
    
   
    $editForm = $this->createForm('VendorWeather\WeatherBundle\Form\RegionType', $region);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();
        }
        return $this->render('WeatherBundle:Dashbord:edit-region.html.twig',array(
            'edit_form' => $editForm->createView(),
        ));
}

public function addAction (Request $request)
{
    /* return $this->render('WeatherBundle:Dashbord:edit-region.html.twig');*/
    
    $region = new region();
    $addForm = $this->createForm('VendorWeather\WeatherBundle\Form\RegionType',$region);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted() && $addForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();
            return $this->redirectToRoute('weather_dashbord');
        }
        return $this->render('WeatherBundle:Dashbord:add-region.html.twig',array(
            'add_form' => $addForm->createView(),
        ));
}

}
