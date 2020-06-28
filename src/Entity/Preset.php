<?php

namespace App\Entity;

use App\Repository\PresetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresetRepository::class)
 */
class Preset
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PresetAttribut::class, mappedBy="preset")
     */
    private $attributID;

    public function __construct()
    {
        $this->attributID = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|PresetAttribut[]
     */
    public function getAttributID(): Collection
    {
        return $this->attributID;
    }

    public function addAttributID(PresetAttribut $attributID): self
    {
        if (!$this->attributID->contains($attributID)) {
            $this->attributID[] = $attributID;
            $attributID->setPreset($this);
        }

        return $this;
    }

    public function removeAttributID(PresetAttribut $attributID): self
    {
        if ($this->attributID->contains($attributID)) {
            $this->attributID->removeElement($attributID);
            // set the owning side to null (unless already changed)
            if ($attributID->getPreset() === $this) {
                $attributID->setPreset(null);
            }
        }

        return $this;
    }
}
