<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    /**
     * @Assert\Length(max=30)
     */
    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[Assert\GreaterThan("now", message: "La date de réservation doit être supérieure à la date du jour")]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[Assert\Positive]
    #[ORM\Column]
    private ?int $nbrGuest = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour = null;

    #[ORM\Column(length: 100)]
    private ?string $meal_allergy = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Users $users = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Restaurant $restaurant = null;

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

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getNbrGuest(): ?int
    {
        return $this->nbrGuest;
    }

    public function setNbrGuest(int $nbrGuest): self
    {
        $this->nbrGuest = $nbrGuest;

        return $this;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getMealAllergy(): ?string
    {
        return $this->meal_allergy;
    }

    public function setMealAllergy(string $meal_allergy): self
    {
        $this->meal_allergy = $meal_allergy;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }
}
