<?php

declare(strict_types=1);

namespace App\Discount;

use App\Discount\DiscountInterface;
use App\Service\DTO\PriceEnquiryInterface;

abstract class AbstractDiscount implements DiscountInterface
{
    private DiscountInterface $nextDiscount;

    public function setNext(DiscountInterface $nextDiscount): DiscountInterface
    {
        $this->nextDiscount = $nextDiscount;
        return $nextDiscount;
    }

    public function apply(PriceEnquiryInterface $priceEnquiry): ?PriceEnquiryInterface
    {
        if (isset($this->nextDiscount)) {
            return $this->nextDiscount->apply($priceEnquiry);
        }

        return $priceEnquiry;
    }
}
