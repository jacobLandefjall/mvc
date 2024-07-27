<?php

namespace App\Entity;

use App\Repository\ProjektRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjektRepository::class)]
class Projekt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $goal = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $values = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(?string $goal): static
    {
        $this->goal = $goal;

        return $this;
    }

    public function getValues(): ?array
    {
        return $this->values;
    }

    public function setValues(?array $values): static
    {
        $this->values = $values;
        return $this;
    }
}
