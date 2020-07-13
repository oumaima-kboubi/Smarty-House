<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeviceController extends AbstractController
{
    /**
     * @Route("/device/{paramRoom?all}", name="device")
     */
    public function index($paramRoom)
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        $house = $repository->find($me->getHouseID());
        if($paramRoom == 'all'){
            $rooms = $house->getRooms();
        }else{
            $rooms = $house->getRoom($paramRoom);
        }
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/DeviceAll/{paramHouse?1}/{paramRoom?all}", name="deviceDebugAll")
     */
    public function GodMode($paramHouse,$paramRoom)
    {
        
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        $house = $repository->find($paramHouse);
        if($paramRoom == 'all'){
            $rooms = $house->getRooms();
        }else{
            $rooms = $house->getRoom($paramRoom);
        }
        return $this->render('device/deviceControlAll.html.twig', [
            'rooms' => $rooms
        ]);
    }
}
