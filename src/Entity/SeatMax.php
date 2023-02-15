<?php

namespace App\Entity;

use App\Repository\SeatMaxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeatMaxRepository::class)]
class SeatMax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NbrSeatMax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrSeatMax(): ?int
    {
        return $this->NbrSeatMax;
    }

    public function setNbrSeatMax(int $NbrSeatMax): self
    {
        $this->NbrSeatMax = $NbrSeatMax;

        return $this;
    }
}
