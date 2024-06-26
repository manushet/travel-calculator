<?php

namespace App\Entity;

use App\Repository\EarlyBookingRangeRuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EarlyBookingRangeRuleRepository::class)]
class EarlyBookingRangeRule
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $bookingDateFrom = null;

    #[ORM\Column(length: 15)]
    private bool $isBookingDateFromNext = true;

    #[ORM\Column(length: 5)]
    private ?string $bookingDateTo = null;

    /**
     * @var Collection<int, EarlyBookingDiscountRule>
     */
    #[ORM\OneToMany(targetEntity: EarlyBookingDiscountRule::class, mappedBy: 'earlyBookingRangeRule', orphanRemoval: true)]
    private Collection $earlyBookingDiscountRules;

    public function __construct()
    {
        $this->earlyBookingDiscountRules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getBookingDateFrom(): ?string
    {
        return $this->bookingDateFrom;
    }

    public function setBookingDateFrom(string $bookingDateFrom): static
    {
        $this->bookingDateFrom = $bookingDateFrom;

        return $this;
    }

    public function setIsBookingYearFromNext(bool $isBookingDateFromNext): void
    {
        $this->isBookingDateFromNext = $isBookingDateFromNext;
    }

    public function getIsBookingYearFromNext(): bool
    {
        return $this->isBookingDateFromNext;
    }

    public function getBookingDateTo(): ?string
    {
        return $this->bookingDateTo;
    }

    public function setBookingDateTo(string $bookingDateTo): static
    {
        $this->bookingDateTo = $bookingDateTo;

        return $this;
    }

    /**
     * @return Collection<int, EarlyBookingDiscountRule>
     */
    public function getEarlyBookingDiscountRules(): Collection
    {
        return $this->earlyBookingDiscountRules;
    }

    public function addEarlyBookingPaymentDiscountRule(EarlyBookingDiscountRule $earlyBookingDiscountRule): static
    {
        if (!$this->earlyBookingDiscountRules->contains($earlyBookingDiscountRule)) {
            $this->earlyBookingDiscountRules->add($earlyBookingDiscountRule);
            $earlyBookingDiscountRule->setEarlyBookingRangeRule($this);
        }

        return $this;
    }

    public function removeEarlyBookingDiscountRule(EarlyBookingDiscountRule $earlyBookingDiscountRule): static
    {
        if ($this->earlyBookingDiscountRules->removeElement($earlyBookingDiscountRule)) {
            // set the owning side to null (unless already changed)
            if ($earlyBookingDiscountRule->getEarlyBookingRangeRule() === $this) {
                $earlyBookingDiscountRule->setEarlyBookingRangeRule(null);
            }
        }

        return $this;
    }
}
