<?php

namespace App\Entity;

use App\Repository\ToggleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ToggleRepository::class)
 */
class Toggle extends Attribut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $onLabel;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $offLable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOnLabel(): ?string
    {
        return $this->onLabel;
    }

    public function setOnLabel(string $onLabel): self
    {
        $this->onLabel = $onLabel;

        return $this;
    }

    public function getOffLable(): ?string
    {
        return $this->offLable;
    }

    public function setOffLable(string $offLable): self
    {
        $this->offLable = $offLable;

        return $this;
    }
}
