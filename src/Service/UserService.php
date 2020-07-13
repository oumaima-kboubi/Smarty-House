<?php
namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
class UserService{

    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    /*public static function getUser($user)
    {
        
        $repository = $this->em->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);
        return $me;
    }*/

    /*public function getUserHouse($user){
        $repository = $this->em->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);//shoudln't this be id?
        $repository = $this->em->getDoctrine()->getRepository('App:SmartHouse');
        return $repository->find($me->getHouseID());
    }*/
}
?>