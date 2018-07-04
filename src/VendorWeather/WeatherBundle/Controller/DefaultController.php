<?php

namespace VendorWeather\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WeatherBundle:Default:index.html.twig');
    }
}
