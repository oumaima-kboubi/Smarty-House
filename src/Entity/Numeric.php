<?php

namespace App\Entity;

use App\Repository\NumericRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NumericRepository::class)
 * @ORM\Table(name="`numeric`")
 */
class Numeric extends Attribut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
