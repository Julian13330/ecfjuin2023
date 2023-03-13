<?php

namespace App\Entity;

use App\Repository\OpeningTimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningTimeRepository::class)]
class OpeningTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $day = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $openSoon = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $closeSoon = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $openNight = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $closeNight = null;

    #[ORM\Column]
    private ?bool $open = null;
   
    #[ORM\ManyToOne(inversedBy: 'openingTimes')]
    private ?Users $users = null;

    #[ORM\OneToMany(mappedBy: 'opening_time', targetEntity: Restaurant::class)]
    private Collection $restaurants;

    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }
    public function getOpenSoon(): ?\DateTimeInterface
    {
        return $this->openSoon;
    }

    public function setOpenSoon(\DateTimeInterface $openSoon): self
    {
        $this->openSoon = $openSoon;

        return $this;
    }

    public function getCloseSoon(): ?\DateTimeInterface
    {
        return $this->closeSoon;
    }

    public function setCloseSoon(\DateTimeInterface $closeSoon): self
    {
        $this->closeSoon = $closeSoon;

        return $this;
    }

    public function getOpenNight(): ?\DateTimeInterface
    {
        return $this->openNight;
    }

    public function setOpenNight(\DateTimeInterface $openNight): self
    {
        $this->openNight = $openNight;

        return $this;
    }

    public function getCloseNight(): ?\DateTimeInterface
    {
        return $this->closeNight;
    }

    public function setCloseNight(\DateTimeInterface $closeNight): self
    {
        $this->closeNight = $closeNight;

        return $this;
    }

    public function isOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(bool $open): self
    {
        $this->open = $open;

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

    /**
     * @return Collection<int, Restaurant>
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants->add($restaurant);
            $restaurant->setOpeningTime($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            // set the owning side to null (unless already changed)
            if ($restaurant->getOpeningTime() === $this) {
                $restaurant->setOpeningTime(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
       
    }

}