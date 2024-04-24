<?php

declare(strict_types=1);

namespace App\Discount;

use App\Service\DTO\PriceEnquiryInterface;

interface DiscountInterface
{
    public function apply(PriceEnquiryInterface $priceEnquiry): ?PriceEnquiryInterface;

    public function setNext(DiscountInterface $nextDiscount): DiscountInterface;
}
