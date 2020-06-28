<?php

namespace App\Entity;

use App\Repository\ActuatorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActuatorRepository::class)
 */
class Actuator
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
    private $phenomenePhysiqueUtilise;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $principeMisEnOeuvre;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $typeEnergieUtilisee;

    /**
     * @ORM\OneToOne(targetEntity=Attribut::class, mappedBy="actuator", cascade={"persist", "remove"})
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

    public function getPhenomenePhysiqueUtilise(): ?string
    {
        return $this->phenomenePhysiqueUtilise;
    }

    public function setPhenomenePhysiqueUtilise(string $phenomenePhysiqueUtilise): self
    {
        $this->phenomenePhysiqueUtilise = $phenomenePhysiqueUtilise;

        return $this;
    }

    public function getPrincipeMisEnOeuvre(): ?string
    {
        return $this->principeMisEnOeuvre;
    }

    public function setPrincipeMisEnOeuvre(string $principeMisEnOeuvre): self
    {
        $this->principeMisEnOeuvre = $principeMisEnOeuvre;

        return $this;
    }

    public function getTypeEnergieUtilisee(): ?string
    {
        return $this->typeEnergieUtilisee;
    }

    public function setTypeEnergieUtilisee(string $typeEnergieUtilisee): self
    {
        $this->typeEnergieUtilisee = $typeEnergieUtilisee;

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
        $newActuator = null === $attribut ? null : $this;
        if ($attribut->getActuator() !== $newActuator) {
            $attribut->setActuator($newActuator);
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
