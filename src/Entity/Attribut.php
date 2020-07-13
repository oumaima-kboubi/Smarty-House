<?php

namespace App\Entity;

use App\Repository\AttributRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type" , type ="string")
 * @ORM\DiscriminatorMap({"toggle"="Toggle","numeric"="Numeric","range"="Range", "attribut"="Attribut"})
 */
class Attribut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity=Metric::class, mappedBy="attribut", orphanRemoval=true)
     * @ORM\OrderBy({"date" = "DESC"})
     */
    protected $metrics;

    /**
     * @ORM\OneToMany(targetEntity=PresetAttribut::class, mappedBy="attribut")
     */
    protected $presetID;

    /**
     * @ORM\OneToOne(targetEntity=Actuator::class, inversedBy="attribut", cascade={"persist", "remove"})
     */
    private $actuator;

    /**
     * @ORM\OneToOne(targetEntity=Sensor::class, inversedBy="attribut", cascade={"persist", "remove"})
     */
    private $sensor;

    /**
     * @ORM\ManyToOne(targetEntity=Device::class, inversedBy="relation")
     */
    private $device;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deviceType;
//
//    /**
//     * @ORM\OneToMany(targetEntity=Device::class, mappedBy="attributs")
//     */
//    private $device;

//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    private $type;

    public function __construct()
    {
        $this->metrics = new ArrayCollection();
        $this->presetID = new ArrayCollection();
        //        $this->device = new ArrayCollection();
    }

    public function getLatestValue(){
        return $this->metrics->first()->getValue();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(){
        $str = get_class($this);
        $strArray = explode('\\',$str);
        return strtolower($strArray[count($strArray)-1]);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Metric[]
     */
    public function getMetrics(): Collection
    {
        return $this->metrics;
    }

    public function addMetric(Metric $metric): self
    {
        if (!$this->metrics->contains($metric)) {
            $this->metrics[] = $metric;
            $metric->setAttribut($this);
        }

        return $this;
    }

    public function removeMetric(Metric $metric): self
    {
        if ($this->metrics->contains($metric)) {
            $this->metrics->removeElement($metric);
            // set the owning side to null (unless already changed)
            if ($metric->getAttribut() === $this) {
                $metric->setAttribut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PresetAttribut[]
     */
    public function getPresetID(): Collection
    {
        return $this->presetID;
    }

    public function addPresetID(PresetAttribut $presetID): self
    {
        if (!$this->presetID->contains($presetID)) {
            $this->presetID[] = $presetID;
            $presetID->setAttribut($this);
        }

        return $this;
    }

    public function removePresetID(PresetAttribut $presetID): self
    {
        if ($this->presetID->contains($presetID)) {
            $this->presetID->removeElement($presetID);
            // set the owning side to null (unless already changed)
            if ($presetID->getAttribut() === $this) {
                $presetID->setAttribut(null);
            }
        }

        return $this;
    }

    public function getActuator(): ?Actuator
    {
        return $this->actuator;
    }

    public function setActuator(?Actuator $actuator): self
    {
        $this->actuator = $actuator;

        return $this;
    }

    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    public function setSensor(?Sensor $sensor): self
    {
        $this->sensor = $sensor;

        return $this;
    }
//
//    /**
//     * @return Collection|Device[]
//     */
//    public function getDevice(): Collection
//    {
//        return $this->device;
//    }
//
//    public function addDevice(Device $device): self
//    {
//        if (!$this->device->contains($device)) {
//            $this->device[] = $device;
//            $device->setAttributs($this);
//        }
//
//        return $this;
//    }
//
//    public function removeDevice(Device $device): self
//    {
//        if ($this->device->contains($device)) {
//            $this->device->removeElement($device);
//            // set the owning side to null (unless already changed)
//            if ($device->getAttributs() === $this) {
//                $device->setAttributs(null);
//            }
//        }
//
//        return $this;
//    }

//    public function getType(): ?string
//    {
//        return $this->type;
//    }
//
//    public function setType(string $type): self
//    {
//        $this->type = $type;
//
//        return $this;
//    }


public function getDevice(): ?Device
{
    return $this->device;
}

public function setDevice(?Device $device): self
{
    $this->device = $device;

    return $this;
}

public function getDeviceType(): ?string
{
    return $this->deviceType;
}

public function setDeviceType(string $deviceType): self
{
    $this->deviceType = $deviceType;

    return $this;
}}
