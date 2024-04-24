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
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $bookingDateFrom = null;

    #[ORM\Column(length: 25)]
    private ?string $bookingYearFrom = null;

    #[ORM\Column(length: 5)]
    private ?string $bookingDateTo = null;

    #[ORM\Column(length: 25)]
    private ?string $bookingYearTo = null;

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

    public function getBookingDateFrom(): ?string
    {
        return $this->bookingDateFrom;
    }

    public function setBookingDateFrom(string $bookingDateFrom): static
    {
        $this->bookingDateFrom = $bookingDateFrom;

        return $this;
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

    public function getBookingYearFrom(): ?string
    {
        return $this->bookingYearFrom;
    }

    public function setBookingYearFrom(string $bookingYearFrom): static
    {
        $this->bookingYearFrom = $bookingYearFrom;

        return $this;
    }

    public function getBookingYearTo(): ?string
    {
        return $this->bookingYearTo;
    }

    public function setBookingYearTo(string $bookingYearTo): static
    {
        $this->bookingYearTo = $bookingYearTo;

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
    public function getBookingNormalizedDateFrom(): ?string
    {
        if ($this->bookingYearFrom && $this->bookingDateFrom) {
            $bookingYearFrom = $this->bookingYearFrom === 'next'
                ? (new \DateTime())->add(new \DateInterval('P1Y'))->format('Y')
                : (new \DateTime())->format('Y');

            return $bookingYearFrom . '-' . $this->bookingDateFrom;
        }
        return null;
    }

    public function getBookingNormalizedDateTo(): ?string
    {
        if ($this->bookingYearTo && $this->bookingDateTo) {
            $bookingYearTo = $this->bookingYearTo === 'next'
                ? (new \DateTime())->add(new \DateInterval('P1Y'))->format('Y')
                : (new \DateTime())->format('Y');

            return $bookingYearTo . '-' . $this->bookingDateTo;
        }
        return null;
    }
}
