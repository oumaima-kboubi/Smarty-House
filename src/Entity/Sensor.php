<?php

namespace App\Entity;

use App\Repository\SensorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SensorRepository::class)
 */
class Sensor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $apportEnergitique;

    /**
     * @ORM\Column(type="float")
     */
    private $seuilDeclenchement;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $typeDetection;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $typeSortie;

    /**
     * @ORM\OneToOne(targetEntity=Attribut::class, mappedBy="sensor", cascade={"persist", "remove"})
     */
    private $attribut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApportEnergitique(): ?string
    {
        return $this->apportEnergitique;
    }

    public function setApportEnergitique(string $apportEnergitique): self
    {
        $this->apportEnergitique = $apportEnergitique;

        return $this;
    }

    public function getSeuilDeclenchement(): ?float
    {
        return $this->seuilDeclenchement;
    }

    public function setSeuilDeclenchement(float $seuilDeclenchement): self
    {
        $this->seuilDeclenchement = $seuilDeclenchement;

        return $this;
    }

    public function getTypeDetection(): ?string
    {
        return $this->typeDetection;
    }

    public function setTypeDetection(string $typeDetection): self
    {
        $this->typeDetection = $typeDetection;

        return $this;
    }

    public function getTypeSortie(): ?string
    {
        return $this->typeSortie;
    }

    public function setTypeSortie(string $typeSortie): self
    {
        $this->typeSortie = $typeSortie;

        return $this;
    }

    public function getAttribut(): ?Attribut
    {
        return $this->attribut;
    }

    public function setAttribut(?Attribut $attribut): self
    {
        $this->attribut = $attribut;

        // set (or unset) the owning side of the relation if necessary
        $newSensor = null === $attribut ? null : $this;
        if ($attribut->getSensor() !== $newSensor) {
            $attribut->setSensor($newSensor);
        }

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
}
