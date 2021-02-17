<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $colors = ["Carreaux", "Coeur", "Pique", "Trèfle"];

    /**
     * @ORM\Column(type="array")
     */
    private $CardValues = ["AS", "5", "10", "8", "6", "5", "7", "4", "2", "3", "9", "Dame", "Roi", "Valet"];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColors(): ?array
    {
        return $this->colors;
    }

    public function setColors(array $colors): self
    {
        $this->colors = $colors;

        return $this;
    }

    public function getCardValues(): ?array
    {
        return $this->CardValues;
    }

    public function setCardValues(array $CardValues): self
    {
        $this->CardValues = $CardValues;

        return $this;
    }
}
