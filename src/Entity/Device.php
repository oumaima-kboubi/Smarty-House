<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviceRepository::class)
 */
class Device
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="devices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roomID;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\OneToMany(targetEntity=Attribut::class, mappedBy="device")
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

//    /**
//     * @ORM\ManyToOne(targetEntity=Attribut::class, inversedBy="device")
//     */
//    private $attributs;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getRoomID(): ?Room
    {
        return $this->roomID;
    }

    public function setRoomID(?Room $roomID): self
    {
        $this->roomID = $roomID;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

//    public function getAttributs(): ?Attribut
//    {
//        return $this->attributs;
//    }
//
//    public function setAttributs(?Attribut $attributs): self
//    {
//        $this->attributs = $attributs;
//
//        return $this;
//    }


public function getPath(): ?string
{
    return $this->path;
}

public function setPath(?string $path): self
{
    $this->path = $path;

    return $this;
}

/**
 * @return Collection|Attribut[]
 */
public function getRelation(): Collection
{
    return $this->relation;
}

public function addRelation(Attribut $relation): self
{
    if (!$this->relation->contains($relation)) {
        $this->relation[] = $relation;
        $relation->setDevice($this);
    }

    return $this;
}

public function removeRelation(Attribut $relation): self
{
    if ($this->relation->contains($relation)) {
        $this->relation->removeElement($relation);
        // set the owning side to null (unless already changed)
        if ($relation->getDevice() === $this) {
            $relation->setDevice(null);
        }
    }

    return $this;
}}
