<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait DiscountValidatorTrait
{
    #[ORM\Column]
    private ?bool $isActive = true;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $validDateFrom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $validDateTo = null;

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getValidDateFrom(): ?\DateTimeInterface
    {
        return $this->validDateFrom;
    }

    public function setValidDateFrom(?\DateTimeInterface $validDateFrom): static
    {
        $this->validDateFrom = $validDateFrom;

        return $this;
    }

    public function getValidDateTo(): ?\DateTimeInterface
    {
        return $this->validDateTo;
    }

    public function setValidDateTo(?\DateTimeInterface $validDateTo): static
    {
        $this->validDateTo = $validDateTo;

        return $this;
    }

    public function isValid(): bool
    {
        $currentDate = (new \DateTime())->format("Y-m-d");

        if (
            (isset($this->validDateFrom) && $currentDate < $this->validDateFrom->format("Y-m-d")) ||
            (isset($this->validDateTo) && $currentDate > $this->validDateTo->format("Y-m-d"))
        ) {
            return false;
        }
        return true;
    }
}
