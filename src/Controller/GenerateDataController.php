<?php

namespace App\Controller;

use App\Entity\Attribut;
use App\Entity\Device;
use App\Entity\Metric;
use App\Entity\Numeric;
use App\Entity\Range;
use App\Entity\Room;
use App\Entity\SmartHouse;
use App\Entity\Toggle;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Faker;

class GenerateDataController extends AbstractController
{
    private $entityManager;
    /**
     * @Route("/generate/addHouse/{nbrHouses?1}", name="generate_house")
     */
    public function generateHouses($nbrHouses)
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        //dump($this->getUsers());
        for($a=0;$a<$nbrHouses;$a++){
            $smartHouse = $this->createSmartHouse($a);
            $rooms = $this->createRooms($smartHouse);
            foreach ($rooms as $room) {
                $this->createDevices($room);
            }
        }
        $this->entityManager->flush();
        return $this->render('generate_data/index.html.twig', [
            'controller_name' => 'Generated Houses',
        ]);
    }

    /**
     * @Route("/generate/addMetrics/{depth?20}", name="generate_metric")
     */
    public function generateMetrics($depth)
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository("App:Attribut");
        $attributes = $repository->findAll();
        foreach ($attributes as $attribute) {
            for ($i=0; $i < $depth; $i++) { 
                $metric = $this->createMetric($attribute);
                $this->entityManager->persist($metric);
            }
        }
        $this->entityManager->flush();
        return $this->render('generate_data/index.html.twig', [
            'controller_name' => 'Generated Metrics',
        ]);
    }

    private function createMetric($attribute){
        if      (is_a($attribute,"App\Entity\Range")){
            return($this->metricRange($attribute));
        }elseif (is_a($attribute,"App\Entity\Toggle")) {
            return($this->metricToggle($attribute));
        }elseif (is_a($attribute,"App\Entity\Numeric")){
            return($this->metricNumeric($attribute));
        }
    }

    private function metricNumeric($numeric){
        $faker =  Faker\Factory::create();
        $metric = new Metric();
        $metric->setAttribut($numeric);
        $metric->setDeleted(false);
        $metric->setTriggeredBy("generated");
        $metric->setValue($faker->randomFloat(2,0,50));
        if(rand(0,1)==0)//50% are generated in a very close date
            $metric->setDate($faker->dateTimeBetween('-1 days','+2 days'));
        else            //the rest are generated for a full year
            $metric->setDate($faker->dateTimeBetween('-1 years'));
        return $metric;
    }

    private function metricRange($range){
        $faker =  Faker\Factory::create();
        $metric = new Metric();
        $metric->setAttribut($range);
        $metric->setDeleted(false);
        $metric->setTriggeredBy("generated");
        $min = $range->getMin(); $max = $range->getMax();
        $metric->setValue($faker->randomFloat(2,$min,$max));
        if(rand(0,1)==0)//50% are generated in a very close date
            $metric->setDate($faker->dateTimeBetween('-1 days','+2 days'));
        else            //the rest are generated for a full year
            $metric->setDate($faker->dateTimeBetween('-1 years'));
        return $metric;
    }

    private function metricToggle($toggle){
        $faker =  Faker\Factory::create();
        $metric = new Metric();
        $metric->setAttribut($toggle);
        $metric->setDeleted(false);
        $metric->setTriggeredBy("generated");
        $metric->setValue($faker->boolean(20));
        if($faker->boolean(60))//60% are generated at a recent date
            $metric->setDate($faker->dateTimeBetween('-1 days','+2 days'));
        else                   //the rest are generated for a full year
            $metric->setDate($faker->dateTimeBetween('-1 years'));
        return $metric;
    }

   /*private function getUsers(){
        $repo = $this->getDoctrine()->getRepository('App:User');
        $result = $repo->findAll();
        $users = [];
        foreach ($result as $entry) {
            if($entry->getLastName()!="admin")
                array_push($users,$entry);
        }
        return $users;
    }*/

    private function createSmartHouse($id){
        $faker =  Faker\Factory::create();
        $house = new SmartHouse();
        $house->setAddress($faker->address);
        $house->setName("House $id");
        $this->entityManager->persist($house);
        return $house;
    }

    private function createRooms($house){
        $roomNames = [
            "Kitchen","Living Room", "Bed Room","Hallway","Bath Room","Front Yard",
            "Back Yard","FrontDoor","Garage", "Baby Room"
        ];
        $rooms = [];
        foreach ($roomNames as $roomName) {
            $room = new Room();
            $room->setName($roomName);
            $room->setHouseID($house);
            array_push($rooms,$room);
            $this->entityManager->persist($room);
        }
        return $rooms;
    }

    private function createDevices($room){
        $deviceNames = ["Heat Sensor", "Exterior Blinds", "Interior Blinds", "Lamp"];
        switch ($room->getName()) {
            case 'Kitchen':
                array_push($deviceNames,"Oven");
                array_push($deviceNames,"Smoke Detector");
                break;
            case 'Living Room':
                array_push($deviceNames,"Mood Light");
                array_push($deviceNames,"O2 sensor");
                array_push($deviceNames,"Air Conditioner");
                break;
            case 'Bed Room':
                array_push($deviceNames,"Mood Light");
                array_push($deviceNames,"O2 sensor");
                array_push($deviceNames,"Air Conditioner");
                break;
            case 'Hallway':
                unset($deviceNames[1]);
                unset($deviceNames[2]);
                break;
            case 'Bath Room':
                array_push($deviceNames,"Bath");
                unset($deviceNames[1]);
                unset($deviceNames[0]);
                break;
            case 'Bath Room':
                array_push($deviceNames,"Bath");
                unset($deviceNames[1]);
                unset($deviceNames[0]);
            break;
            case 'Front Yard':
                unset($deviceNames[0]);
                unset($deviceNames[1]);
                unset($deviceNames[2]);
            break;
            case 'Back Yard':
                unset($deviceNames[0]);
                unset($deviceNames[1]);
                unset($deviceNames[2]);
                array_push($deviceNames,"Motion Sensor");
            break;
            case 'Front Door':
                unset($deviceNames[0]);
                unset($deviceNames[1]);
                unset($deviceNames[2]);
            break;
            case 'Garage':
                unset($deviceNames[1]);
                array_push($deviceNames,"Garage Door");
                array_push($deviceNames,"Motion Sensor");
            break;
            case 'Baby Room':
                array_push($deviceNames,"O2 sensor");
                array_push($deviceNames,"Air Conditioner");
            break;
            default:
                break;
        }
        $devices = [];
        foreach ($deviceNames as $deviceName) {
            $device = $this->createDevice($deviceName,$room);
            array_push($devices, $device);
            $this->entityManager->persist($device);
        }
        return $devices;
    }

    private function createDevice($deviceName,$room){
        $faker =  Faker\Factory::create();
        $device = new Device();
        $device->setName($deviceName);
        $device->setIcon("placeHolder");
        $device->setRoomID($room);
        $device->setType("placeHolder");
        $device->setDescription($faker->text(240));
        $device->setCreatedAt($faker->dateTime());
        $attributes = $this->craeteAttributes($device);
        foreach ($attributes as $attribute) {
            $attribute->setDevice($device);
            $this->entityManager->persist($attribute);
        }
        return $device;
    }

    private function craeteAttributes($device){
        $atts = [];
        switch ($device->getName()) {
            case 'Heat Sensor':
                array_push($atts,$this->newNumeric("Temperature","°C","sensor"));
                break;
            case 'Exterior Blinds':
                array_push($atts,$this->newRange("Open",0,100,"%","actuator"));
                //array_push($atts,$this->newToggle("Orientation","Interior","Exterior"));
                break;
            case 'Interior Blinds':
                array_push($atts,$this->newRange("Open",0,100,"%","actuator"));
                //array_push($atts,$this->newToggle("Orientation","Interior","Exterior"));
                break;
            case 'Lamp':
                array_push($atts,$this->newToggle("Switch","On","Off","actuator"));
                break;
            case 'Oven':
                array_push($atts,$this->newRange("Heat",0,350,"°C","actuator"));
                array_push($atts,$this->newToggle("Timer Done","Triggered","Off","sensor"));
                break;
            case 'Oven':
                array_push($atts,$this->newRange("Heat",0,350,"°C","actuator"));
                array_push($atts,$this->newToggle("Timer Done","Triggered","Off","sensor"));
                break;
            case 'Smoke Detector':
                array_push($atts,$this->newToggle("Alarm","Triggered","Off","sensor"),);
                break;
            case 'Mood Light':
                array_push($atts,$this->newRange("intensity",0,100,"Si","actuator"));
                array_push($atts,$this->newToggle("Switch","On","Off","actuator"));
                break;
            case 'O2 Sensor':
                array_push($atts,$this->newNumeric("O2 Level","%","sensor"));
                break;
            case 'Air Conditioner':
                array_push($atts,$this->newRange("Fan Speed",0,10,"Rpm","actuator"));
                array_push($atts,$this->newRange("Temperature",0,100,"°C","actuator"));
                array_push($atts,$this->newToggle("Swey","On","Off","actuator"));
                break;
            case 'Bath':
                array_push($atts,$this->newRange("Water Temperature",0,60,"°C","actuator"));
                break;
            case 'Motion Sensor':
                array_push($atts,$this->newToggle("Alarm","Triggered","Off","sensor"));
                break;
            case 'Garage Door':
                array_push($atts,$this->newRange("Open",0,100,"%","actuator"));
                break;
            default:break;
        }
        return $atts;
    }

    private function newRange($name,$min,$max,$unit,$type){
        $range = new Range();
        $range->setName($name);
        $range->setMin($min);
        $range->setMax($max);
        $range->setUnit($unit);
        $range->setDeviceType($type);
        
        /*sensor/actuator code (ranges are always an actuator)
            $actuator = new Actuator();
            //add fields (you may need to add $range in setAttribut)
            //$entityManager->persist($actuator);
        */
        return $range;
    }

    private function newNumeric($name,$unit,$type){
        $numeric = new Numeric();
        $numeric->setName($name);
        $numeric->setUnit($unit);
        $numeric->setDeviceType($type);
        //unit is missing
        /*sensor/actuator code (numerics are always a sensor)
            $sensor = new Sensor();
            //add fields (you may need to add $sensor in setAttribut)
            //$entityManager->persist($sensor);
        */
        return $numeric;
    }
    
    private function newToggle($name,$onLable,$offLable,$type){
        $toggle = new Toggle();
        $toggle->setName($name);
        $toggle->setOnLabel($onLable);
        $toggle->setOffLable($offLable);
        $toggle->setDeviceType($type);
        /*sensor/actuator code (toggles can be sensors (alarm) or actuator (on/off switch))
            //this one is tricky you either create a sensor or an actuator based on the name
            //in a switch($name)
            //do newNumeric and newRange before
        */
        return $toggle;
    }
}
