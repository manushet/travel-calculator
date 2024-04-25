<?php

declare(strict_types=1);

namespace App\Service;

use App\Discount\AgeDiscount;
use App\Discount\EarlyBookingDiscount;
use App\Service\DTO\PriceEnquiryInterface;

class TravelPriceCalculator
{
    public function __construct(
        private AgeDiscount $ageDiscount,
        private EarlyBookingDiscount $earlyBookingDiscount
    ) {
    }

    public function calculate(PriceEnquiryInterface $priceEnquiry): PriceEnquiryInterface
    {
        $this->ageDiscount->setNext($this->earlyBookingDiscount);

        $finalPriceEnquiry = $this->ageDiscount->apply($priceEnquiry);

        return $finalPriceEnquiry;
    }
}
