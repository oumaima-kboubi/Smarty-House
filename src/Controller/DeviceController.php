<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeviceController extends AbstractController
{
    /**
     * @Route("/device/{paramRoom?all}", name="device")
     */
    public function Devices($paramRoom)
    {
        $house = $this->getHouse();
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
     * @Route("/lighting", name="devicelight")
     */
    public function Lighting()
    {
        $house = $this->getHouse();  
        $rooms = $this->filterByType($house->getRooms(),"lighting");
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/temperature", name="devicetemp")
     */
    public function temperature()
    {

        $house = $this->getHouse();
        $rooms = $house->getRooms();
        $rooms = $this->filterByType($house->getRooms(),"temperature");
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/security", name="devicesecure")
     */
    public function security()
    {
        $house = $this->getHouse();
        $rooms = $house->getRooms();
        $rooms = $this->filterByType($house->getRooms(),"security");
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/camera", name="devicecamera")
     */
    public function camera()
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        $house = $repository->find($me->getHouseID());
        $cameras = $house->getCameras();
        return $this->render('device/camera.html.twig', [
            'cameras' => $cameras
        ]);
    }

    /**
     * @Route("/DeviceAll/{paramHouse?1}/{paramRoom?all}", name="deviceDebugAll")
     */
    public function GodMode($paramHouse,$paramRoom)
    {
        //used to simulate the actual devices, can access anything anywhere
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

    private function getHouse(){
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        $house = $repository->find($me->getHouseID());
        return $house;
    }

    private function filterByType($rooms,$type){
        foreach ($rooms as $room) {
            foreach($room->getDevices() as $device){
                if($device->getType()!=$type)
                    $room->getDevices()->removeElement($device);
            }
            if($room->getDevices()->isEmpty())
                $rooms->removeElement($room);
        }
        return $rooms;
    }
}
