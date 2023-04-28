<?php

namespace App\Entity;

use App\Repository\SeatMaxRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: SeatMaxRepository::class)]
class SeatMax
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private $id;

    #[Assert\Positive]
    #[ORM\Column]
    private ?int $NbrSeatMax = null;

    public function getId(): ?Uuid
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
