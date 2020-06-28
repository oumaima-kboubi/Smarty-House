<?php

namespace App\Entity;

use App\Repository\PresetAttributRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresetAttributRepository::class)
 */
class PresetAttribut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Attribut::class, inversedBy="presetID")
     */
    private $attribut;

    /**
     * @ORM\ManyToOne(targetEntity=Preset::class, inversedBy="attributID")
     */
    private $preset;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAttribut(): ?Attribut
    {
        return $this->attribut;
    }

    public function setAttribut(?Attribut $attribut): self
    {
        $this->attribut = $attribut;

        return $this;
    }

    public function getPreset(): ?Preset
    {
        return $this->preset;
    }

    public function setPreset(?Preset $preset): self
    {
        $this->preset = $preset;

        return $this;
    }
}
