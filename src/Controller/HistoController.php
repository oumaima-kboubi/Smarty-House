<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HistoController extends AbstractController
{
    /**
     * @Route("/histo", name="histo")
     */
    public function list(){
        $repository=$this
            ->getDoctrine()
            ->getRepository(Device::class);
        $devices=$repository->findDevices();
        return $this->render('histo/his.html.twig',[
            'devices' => $devices
        ]);
    }
    /**
     * @Route("/consult/{id}", name="histo.consult")
     */
    public function consult($id) {
        $historiques = $this->getDoctrine()->getRepository(Metric::class);
        $exist = $historiques->findBy([ 'deviceId' => $id, 'delete' => 0 ]);
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
        return new Response(
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
            $exist->setDelete(1);
            $manager->persist($exist);
            $manager->flush();
            $this->addFlash('success', 'Ligne supprimé avec succes');
        } else {
            $this->addFlash('error', 'Id n\'existe pas');
        }
        return $this->redirectToRoute('histo.consult', [ 'id' => $idd ]);
    }
    /**
     * @Route("/consult/camera",  name="consult.camera")
     */
    public function camera()
    {
        $camera = $this->getDoctrine()->getRepository(Camera::class)->findAll();
        return $this->render('histo/camera.html.twig', array(
            'camera' => $camera
        ));
    }
    /**
     * @Route("consult/device", name="consult.device")
     */
    public function actuator()
    {
        $device = $this->getDoctrine()->getRepository(Device::class)->findDevices($houseid);
        $actuator = $this->getDoctrine()->getRepository(Actuator::class)->findActuator($houseid);
        $sensor = $this->getDoctrine()->getRepository(Sensor::class)->findSensor($houseid);
        return $this->render('histo/list.html.twig', array(
            'devices' => $device,
            'actuators' => $actuator,
            'sensors' => $sensor
        ));
    }

}
