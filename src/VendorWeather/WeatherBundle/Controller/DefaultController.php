<?php

namespace VendorWeather\WeatherBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VendorWeather\WeatherBundle\Entity\Region;
use VendorWeather\WeatherBundle\Form\RegionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $region = new region();
   
         // On crée le FormBuilder grâce au service form factory
    $searchform = $this->get('form.factory')->create(RegionType::class, $region);
  /*  $searchform = handleRequest($request);*/ 
    $searchform = $this->createFormBuilder()
    ->add('name', TextType::class)
    ->getForm();

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('WeatherBundle:Default:index.html.twig', array(
      'search_form' => $searchform ->createView(),
    ));
    }
}
