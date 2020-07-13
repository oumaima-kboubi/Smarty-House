<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;
use App\Entity\User;
use App\Entity\Device;
use App\Entity\Metric;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart/news", name="chart.news")
     */
    public function index()
    {
        $user = $this->getUser();
        $me = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $user->getUsername()]);
        $device = $this->getDoctrine()->getRepository(Device::class)->findDevices($me->getHouseId());
        $repository =$this
            ->getDoctrine()
            ->getRepository(News::class);
        $news= $repository->findByThree();

        return $this->render('chart/news.html.twig', array(
            'news' => $news,
            'devices' => $device
        ));
    }
    /**
     * @Route("/chart/graph/{id}", name="chart.graph")
     */
    public function graph($id)
    {
        $user = $this->getUser();
        $me = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $user->getUsername()]);
        $devices=$this->getDoctrine()->getRepository(Device::class)->findDevices($me->getHouseId());
        $today = date("Y-m-d");
        $lastweek = date("Y-m-d",strtotime('-7 day'));
        $lastmonth = date("Y-m-d",strtotime('-30 day'));
        $stat = $this->getDoctrine()->getRepository(Metric::class);
        $exist = $stat->findLine($id);
        $week = $stat->findByDatou($id, $lastweek, $today);
        $pie = $stat->findDevice($me->getHouseId(),$today);
        $dough = $stat->findDevice($me->getHouseId(),$lastmonth);
        if($exist) {
            return $this->render('chart/graph.html.twig', [
                'stats' => $exist,
                'weeks' => $week,
                'devices' => $devices,
                'pies' => $pie,
                'doughs' => $dough,
                'id' => $id
            ]);
        }
        return new \Symfony\Component\HttpFoundation\Response(
            "<h1>This Device do not have a history of usage</h1>"
        );
    }
}
