<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WebsocketController extends AbstractController
{
    /**
     * @Route("/websocket/actuator/{attributeID}/{date}/{value?0}", name="websocket_Metric")
     */
    public function index($attributeID, $value, $date)
    {
        //exemple attributID "attributeActuator15" where id=15
        //check what i sent you a while ago for help
        //returns JsonResponse(['isRequestTreated' => "true"]); if done
        return $this->render('websocket/index.html.twig', [
            'controller_name' => 'WebsocketController',
        ]);
    }
}
