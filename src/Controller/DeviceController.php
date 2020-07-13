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
    public function Devices($paramRoom)
    {
        /*$user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);*/
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        /*$house = $repository->find($me->getHouseID());*/ $house = $repository->find(4); //<--- delete this and uncomment the rest
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
        /*$user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);*/
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        /*$house = $repository->find($me->getHouseID());*/ $house = $repository->find(4); //<--- delete this and uncomment the rest
            $rooms = $house->getRooms();
            foreach ($rooms as $room) {
                foreach($room->getDevices() as $device){
                    if($device->getType()!="lighting")
                        $room->getDevices()->removeElement($device);
                }
                if($room->getDevices()->isEmpty())
                    $rooms->removeElement($room);
            }
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/temperature", name="devicetemp")
     */
    public function temperature()
    {
        /*$user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);*/
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        /*$house = $repository->find($me->getHouseID());*/ $house = $repository->find(4); //<--- delete this and uncomment the rest
            $rooms = $house->getRooms();
            foreach ($rooms as $room) {
                foreach($room->getDevices() as $device){
                    if($device->getType()!="temperature")
                        $room->getDevices()->removeElement($device);
                }
                if($room->getDevices()->isEmpty())
                    $rooms->removeElement($room);
            }
            
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/security", name="devicesecure")
     */
    public function security()
    {
        /*$user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);*/
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        /*$house = $repository->find($me->getHouseID());*/ $house = $repository->find(4); //<--- delete this and uncomment the rest
            $rooms = $house->getRooms();
            foreach ($rooms as $room) {
                foreach($room->getDevices() as $device){
                    if($device->getType()!="security")
                        $room->getDevices()->removeElement($device);
                }
                if($room->getDevices()->isEmpty())
                    $rooms->removeElement($room);
            }
            
        return $this->render('device/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route("/camera", name="devicecamera")
     */
    public function camera()
    {
        /*$user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);*/
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        /*$house = $repository->find($me->getHouseID());*/ $house = $repository->find(4); //<--- delete this and uncomment the rest
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
}
