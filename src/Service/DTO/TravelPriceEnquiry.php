<?php

declare(strict_types=1);

namespace App\Service\DTO;

use App\Service\DTO\PriceEnquiryInterface;

class TravelPriceEnquiry implements PriceEnquiryInterface
{
    private ?int $basePrice;

    private ?float $finalPrice;

    private string $participantBirthday;

    private string $travelStart;

    private string $paymentDate;

    public function __construct(
        ?string $basePrice,

        ?string $participantBirthday,

        ?string $travelStart,

        ?string $paymentDate
    ) {
        $this->basePrice = (int)$basePrice;
        $this->finalPrice = (float)$basePrice;
        $this->participantBirthday = $participantBirthday;
        $this->travelStart = $travelStart;
        $this->paymentDate = $paymentDate;
    }

    public function getBasePrice(): int
    {
        return $this->basePrice;
    }

    public function setBasePrice(string|int $basePrice): void
    {
        $this->basePrice = (int)$basePrice;
    }

    public function getFinalPrice(): float
    {
        return $this->finalPrice;
    }

    public function setFinalPrice(string|float $finalPrice): void
    {
        $this->finalPrice = (float)$finalPrice;
    }

    public function getParticipantBirthday(): string
    {
        return $this->participantBirthday;
    }

    public function setParticipantBirthday(string $participantBirthday): void
    {
        $this->participantBirthday = $participantBirthday;
    }

    public function getTravelStart(): string
    {
        return $this->travelStart;
    }

    public function setTravelStart(string $travelStart): void
    {
        $this->travelStart = $travelStart;
    }

    public function getPaymentDate(): string
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(string $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }
}
