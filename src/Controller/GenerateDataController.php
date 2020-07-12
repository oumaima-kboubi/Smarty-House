<?php

namespace App\Controller;

use App\Entity\Attribut;
use App\Entity\Device;
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
    /**
     * @Route("/generate/addHouse/{nbrHouses?1}", name="generate_data")
     */
    public function index($nbrHouses)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        for($a=0;$a<$nbrHouses;$a++){
            $smartHouse = $this->createSmartHouse($a);
            $rooms = $this->createRooms($smartHouse);
            foreach ($rooms as $room) {
                $this->createDevices($room);
            }
            dump($smartHouse);
        }
        //$entityManager->persist($flush);
        return $this->render('generate_data/index.html.twig', [
            'controller_name' => 'GenerateDataController',
        ]);
    }

    private function createSmartHouse($id){
        $faker =  Faker\Factory::create();
        $house = new SmartHouse();
        $house->setAddress($faker->address);
        $house->setName("House $id");
        //$entityManager->persist($house);
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
            //$entityManager->persist($room);
            dump($room);
            array_push($rooms,$room);
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
            dump($device);
            //$entityManager->persist($device);
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
            dump($attribute);
            //$entityManager->persist($attribute);
        }
        return $device;
    }

    private function craeteAttributes($device){
        $atts = [];
        switch ($device->getName()) {
            case 'Heat Sensor':
                array_push($atts,$this->newNumeric("Temperature","°C"));
                break;
            case 'Exterior Blinds':
                array_push($atts,$this->newRange("Open",0,100,"%"));
                //array_push($atts,$this->newToggle("Orientation","Interior","Exterior"));
                break;
            case 'Interior Blinds':
                array_push($atts,$this->newRange("Open",0,100,"%"));
                //array_push($atts,$this->newToggle("Orientation","Interior","Exterior"));
                break;
            case 'Lamp':
                array_push($atts,$this->newToggle("Switch","On","Off"));
                break;
            case 'Oven':
                array_push($atts,$this->newRange("Heat",0,350,"°C"));
                array_push($atts,$this->newToggle("Timer Done","Triggered","Off"),);
                break;
            case 'Oven':
                array_push($atts,$this->newRange("Heat",0,350,"°C"));
                array_push($atts,$this->newToggle("Timer Done","Triggered","Off"),);
                break;
            case 'Smoke Detector':
                array_push($atts,$this->newToggle("Alarm","Triggered","Off"),);
                break;
            case 'Mood Light':
                array_push($atts,$this->newRange("intensity",0,100,"Si"));
                array_push($atts,$this->newToggle("Switch","On","Off"));
                break;
            case 'O2 Sensor':
                array_push($atts,$this->newNumeric("O2 Level","%"));
                break;
            case 'Air Conditioner':
                array_push($atts,$this->newRange("Fan Speed",0,10,"Rpm"));
                array_push($atts,$this->newRange("Temperature",0,100,"°C"));
                array_push($atts,$this->newToggle("Swey","On","Off"));
                break;
            case 'Bath':
                array_push($atts,$this->newRange("Water Temperature",0,60,"°C"));
                break;
            case 'Motion Sensor':
                array_push($atts,$this->newToggle("Alarm","Triggered","Off"));
                break;
            case 'Garage Door':
                array_push($atts,$this->newRange("Open",0,100,"%"));
                break;
            default:break;
        }
        return $atts;
    }

    private function newRange($name,$min,$max,$unit){
        $range = new Range();
        $range->setName($name);
        $range->setMin($min);
        $range->setMax($max);
        $range->setUnit($unit);
        
        /*sensor/actuator code (ranges are always an actuator)
            $actuator = new Actuator();
            //add fields (you may need to add $range in setAttribut)
            //$entityManager->persist($actuator);
        */
        return $range;
    }

    private function newNumeric($name,$unit){
        $numeric = new Numeric();
        $numeric->setName($name);
        $numeric->setUnit($unit);
        //unit is missing
        /*sensor/actuator code (numerics are always a sensor)
            $sensor = new Sensor();
            //add fields (you may need to add $sensor in setAttribut)
            //$entityManager->persist($sensor);
        */
        return $numeric;
    }
    
    private function newToggle($name,$onLable,$offLable){
        $toggle = new Toggle();
        $toggle->setName($name);
        $toggle->setOnLabel($onLable);
        $toggle->setOffLable($offLable);
        /*sensor/actuator code (toggles can be sensors (alarm) or actuator (on/off switch))
            //this one is tricky you either create a sensor or an actuator based on the name
            //in a switch($name)
            //do newNumeric and newRange before
        */
        return $toggle;
    }
}
