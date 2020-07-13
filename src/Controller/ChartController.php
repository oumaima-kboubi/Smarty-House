<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart/news", name="chart.news")
     */
    public function index()
    {
        $repository =$this
            ->getDoctrine()
            ->getRepository(News::class);
        $news= $repository->findByThree();

        return $this->render('chart/news.html.twig', array(
            'news' => $news
        ));
    }
    /**
     * @Route("/chart/graph/{id}", name="chart.graph")
     */
    public function graph($id)
    {
        $devices=$this->getDoctrine()->getRepository(Device::class)->findDevices($houseid);
        $today = date("Y-m-d");
        $lastweek = date("Y-m-d",strtotime('-7 day'));
        $lastmonth = date("Y-m-d",strtotime('-30 day'));
        $stat = $this->getDoctrine()->getRepository(Metric::class);
        $exist = $stat->findLine($id);
        $week = $stat->findByDatou($id, $lastweek, $today);
        $pie = $stat->findDevice($today);
        $dough = $stat->findDevice($lastmonth);
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
