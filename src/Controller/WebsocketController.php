<?php

namespace App\Controller;

use App\Entity\Metric;
use DateTime;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WebsocketController extends AbstractController
{
    /**
     * @Route("/websocket/actuator/{attributeID}/{date}/{value?0}", name="websocket_Metric")
     */
    public function index($attributeID, $value, $date)
    {
        if(1 == 1){
            $attributeID = substr($attributeID,15);
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository('App:Attribut');
            $attribute = $repository->find($attributeID);
            $metric = new Metric();
            $metric->setDeleted(false);
            $metric->setAttribut($attribute);
            $metric->setValue($value);
            $metric->setTriggeredBy("placeHolder");
            $metric->setDate(new DateTime("@$date"));
            $entityManager->persist($metric);
            $entityManager->flush();
            return new JsonResponse(['isRequestTreated' => "true"]);
        }else{
            return new JsonResponse(['isRequestTreaded' => "false"]);
        }
    }
}
