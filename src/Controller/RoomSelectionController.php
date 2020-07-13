<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoomSelectionController extends AbstractController
{
    /**
     * @Route("/rooms", name="room_selection")
     */
    public function index()
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);
        $repository = $this->getDoctrine()->getRepository('App:SmartHouse');
        $house = $repository->find($me->getHouseID());
        $rooms = $house->getRooms();
        return $this->render('room_selection/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }
}
