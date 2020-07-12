<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeviceController extends AbstractController
{
    /**
     * @Route("/device/{paramHouse}/{paramRoom?all}", name="device")
     */
    public function index($paramHouse, $paramRoom)
    {
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        $house = $repository->find($paramHouse);
        if($paramRoom == 'all'){
            $rooms = $house->getRooms();
        }else{
            $rooms = $house->getRoom($paramRoom);
        }
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }
}
