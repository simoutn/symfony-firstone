<?php

namespace VendorWeather\WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        // get the login error if there is one
       
       //     $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
  //  $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('WeatherBundle:Default:login.html.twig');
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->render('WeatherBundle:Security:logout.html.twig', array(
            // ...
        ));
    }

}
