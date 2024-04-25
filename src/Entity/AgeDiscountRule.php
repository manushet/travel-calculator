<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\DiscountValidatorTrait;
use App\Repository\AgeDiscountRuleRepository;

#[ORM\Entity(repositoryClass: AgeDiscountRuleRepository::class)]
class AgeDiscountRule
{
    use DiscountValidatorTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $minAgeLimit = 0;

    #[ORM\Column]
    private ?int $maxAgeLimit = 0;

    #[ORM\Column]
    private ?float $modifier = null;

    #[ORM\Column]
    private ?int $amountLimit = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }    

    public function getMinAgeLimit(): ?int
    {
        return $this->minAgeLimit;
    }

    public function setMinAgeLimit(int $minAgeLimit): static
    {
        $this->minAgeLimit = $minAgeLimit;

        return $this;
    }

    public function getMaxAgeLimit(): ?int
    {
        return $this->maxAgeLimit;
    }

    public function setMaxAgeLimit(int $maxAgeLimit): static
    {
        $this->maxAgeLimit = $maxAgeLimit;

        return $this;
    }

    public function getModifier(): ?float
    {
        return $this->modifier;
    }

    public function setModifier(float $modifier): static
    {
        $this->modifier = $modifier;

        return $this;
    }

    public function getAmountLimit(): ?int
    {
        return $this->amountLimit;
    }

    public function setAmountLimit(int $amountLimit): static
    {
        $this->amountLimit = $amountLimit;

        return $this;
    }
}