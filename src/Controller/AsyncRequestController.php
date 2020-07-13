<?php

namespace App\Controller;

use App\Entity\Metric;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AsyncRequestController extends AbstractController
{
    /**
     * @Route("/async/graph", name="async_request")
     */
    public function graph(Request $request){
        $id = $request->request->get('attributeID');
        $repository = $this->getDoctrine()->getRepository(Metric::class);
        $metrics = $repository->findToday($id);
        $graphValues = [];
        foreach ($metrics as $metric) {
            $entry = (['x' => $metric->getDate()->format('H:i:s'), 'y' => $metric->getValue()]);
            array_push($graphValues,$entry);
        }
        return new JsonResponse(['id' => $id, 'values' => $graphValues]);
    }
}
