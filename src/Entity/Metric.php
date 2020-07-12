<?php

namespace App\Entity;

use App\Repository\MetricRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetricRepository::class)
 */
class Metric
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
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Attribut::class, inversedBy="metrics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $triggeredBy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getTriggeredBy(): ?string
    {
        return $this->triggeredBy;
    }

    public function setTriggeredBy(string $triggeredBy): self
    {
        $this->triggeredBy = $triggeredBy;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}
