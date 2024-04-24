<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\DiscountValidatorTrait;
use App\Repository\EarlyBookingDiscountRuleRepository;

#[ORM\Entity(repositoryClass: EarlyBookingDiscountRuleRepository::class)]
class EarlyBookingDiscountRule
{
    use DiscountValidatorTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $paymentDateFrom = null;

    #[ORM\Column(length: 25)]
    private ?string $paymentYearFrom = null;

    #[ORM\Column(length: 5)]
    private ?string $paymentDateTo = null;

    #[ORM\Column(length: 25)]
    private ?string $paymentYearTo = null;

    #[ORM\Column]
    private ?float $modifier = null;

    #[ORM\Column]
    private ?int $amountLimit = 0;


    #[ORM\ManyToOne(inversedBy: 'earlyBookingDiscountRules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EarlyBookingRangeRule $earlyBookingRangeRule = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentDateFrom(): ?string
    {
        return $this->paymentDateFrom;
    }

    public function setPaymentDateFrom(string $paymentDateFrom): static
    {
        $this->paymentDateFrom = $paymentDateFrom;

        return $this;
    }

    public function getPaymentDateTo(): ?string
    {
        return $this->paymentDateTo;
    }

    public function setPaymentDateTo(string $paymentDateTo): static
    {
        $this->paymentDateTo = $paymentDateTo;

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

    public function getPaymentYearFrom(): ?string
    {
        return $this->paymentYearFrom;
    }

    public function setPaymentYearFrom(string $paymentYearFrom): static
    {
        $this->paymentYearFrom = $paymentYearFrom;

        return $this;
    }

    public function getPaymentYearTo(): ?string
    {
        return $this->paymentYearTo;
    }

    public function setPaymentYearTo(string $paymentYearTo): static
    {
        $this->paymentYearTo = $paymentYearTo;

        return $this;
    }


    public function getEarlyBookingRangeRule(): ?EarlyBookingRangeRule
    {
        return $this->earlyBookingRangeRule;
    }

    public function setEarlyBookingRangeRule(?EarlyBookingRangeRule $earlyBookingRangeRule): static
    {
        $this->earlyBookingRangeRule = $earlyBookingRangeRule;

        return $this;
    }

    public function getPaymentNormalizedDateFrom(): ?string
    {
        if ($this->paymentYearFrom && $this->paymentDateFrom) {
            $paymentYearFrom = $this->paymentYearFrom === 'next'
                ? (new \DateTime())->add(new \DateInterval('P1Y'))->format('Y')
                : (new \DateTime())->format('Y');

            return $paymentYearFrom . '-' . $this->paymentDateFrom;
        }
        return null;
    }

    public function getPaymentNormalizedDateTo(): ?string
    {
        if ($this->paymentYearTo && $this->paymentDateTo) {
            $paymentYearTo = $this->paymentYearTo === 'next'
                ? (new \DateTime())->add(new \DateInterval('P1Y'))->format('Y')
                : (new \DateTime())->format('Y');

            return $paymentYearTo . '-' . $this->paymentDateTo;
        }
        return null;
    }
}
