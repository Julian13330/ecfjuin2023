<?php

namespace App\Entity;

use App\Repository\FormulaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormulaRepository::class)]
class Formula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @Assert\Length(max=100)
     */
    #[ORM\Column(length: 100)]
    private ?string $title = null;

    /**
     * @Assert\Length(max=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Assert\Positive]
    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'formulas')]
    private ?Menu $menu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
