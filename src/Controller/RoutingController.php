<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoutingController extends AbstractController
{
    /**
     * @Route("/routing", name="routing")
     */
    public function index()
    {
        return $this->render('routing/index.html.twig', [
            'controller_name' => 'RoutingController',
        ]);
    }

    /**
     * @Route("/privacyIn" , name="routing.privacyIn")
     *
     */
    public function privacyIn () {
        return $this->render('privacyPolicy.html.twig');
    }
    /**
     * @Route("/privacyOut" , name="routing.privacyOut")
     *
     */
    public function privacyOut () {
        return $this->render('privacyPolicyOut.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/useIn",name="routing.useIn")
     */
    public function useIn(){
        return $this->render('TermOfUseIn.html.twig');
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/useOut",name="routing.useOut")
     */
    public function useOut(){
        return $this->render('TermOfUseOut.html.twig');
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/homeIn",name="routing.homeIn")
     */
    public function homeIn(){
        return $this->render('home.html.twig');
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/services",name="routing.services")
     */
    public function services(){
        return $this->render('services.html.twig');
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/homeOut",name="routing.homeOut")
     */
    public function acceuil(){
        return $this->render('lobby.html.twig');
    }

//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//public function residentList(){
//        return $this->render('resident/index.html.twig');
//}
}
