<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Device;
use App\Entity\User;
use App\Entity\Metric;
use App\Entity\Attribut;
use App\Entity\Camera;
use App\Entity\Sensor;
use App\Entity\Actuator;

class HistoController extends AbstractController
{
    /**
     * @Route("/histo", name="histo")
     */
    public function list(){
        $user = $this->getUser();
        $me = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $user->getUsername()]);
        $repository=$this
            ->getDoctrine()
            ->getRepository(Device::class);
        $devices=$repository->findDevices($me->getHouseId());
        return $this->render('histo/his.html.twig',[
            'devices' => $devices
        ]);
    }
    /**
     * @Route("/consult/{id}", name="histo.consult")
     */
    public function consult($id) {

        $historiques = $this->getDoctrine()->getRepository(Metric::class);
        $exist = $historiques->findMy($id);
        $today = date("Y-m-d");
        $lastweek = date("Y-m-d",strtotime('-7 day'));
        $lastmonth= date("Y-m-d",strtotime('-30 day'));
        $lastweeks = $historiques->findForWeek($id, $today, $lastweek);
        $lastmonths = $historiques->findForMonth($id, $lastweek, $lastmonth);
        $rest = $historiques->findTheRest($id, $lastmonth);

        $devices = $this->getDoctrine()->getRepository(Device::class);
        $device = $devices->findOneBy(['id' => $id]);
        if($exist) {
            return $this->render('histo/h.html.twig', [
                'listes' => $exist,
                'place' => $id,
                'gadget' => $device,
                'weeks' => $lastweeks,
                'months' => $lastmonths,
                'rests' => $rest
            ]);
        }
        return new Symfony\Component\HttpFoundation\Response(
            "<h1>This page is currently empty</h1>"
        );
    }
    /**
     * @Route("/histodelete/{id}/{idd}", name="histo.delete")
     */
    public function delete($id, $idd) {
        $repository= $this->getDoctrine()->getRepository(Metric::class);
        $exist = $repository->find($id);
        if($exist) {
            $manager=$this->getDoctrine()->getManager();
            $exist->setDeleted(1);
            $manager->persist($exist);
            $manager->flush();
            $this->addFlash('success', 'Ligne supprimé avec succes');
        } else {
            $this->addFlash('error', 'Id n\'existe pas');
        }
        return $this->redirectToRoute('histo.consult', [ 'id' => $idd ]);
    }
    /**
     * @Route("/see/camera",  name="consult.camera")
     */
    public function camera()
    {
        $camera = $this->getDoctrine()->getRepository(Camera::class)->findAll();
        return $this->render('histo/camera.html.twig', array(
            'camera' => $camera
        ));
    }
    /**
     * @Route("/see/device", name="consult.device")
     */
    public function actuator()
    {
        $user = $this->getUser();
        $me = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $user->getUsername()]);
        $device = $this->getDoctrine()->getRepository(Device::class)->findDevices($me->getHouseId());
        $actuator = $this->getDoctrine()->getRepository(Actuator::class)->findActuator($me->getHouseId());
        $sensor = $this->getDoctrine()->getRepository(Sensor::class)->findSensor($me->getHouseId());
        return $this->render('histo/sensor.html.twig', array(
            'devices' => $device,
            'actuators' => $actuator,
            'sensors' => $sensor
        ));
    }

}
