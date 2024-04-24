<?php

declare(strict_types=1);

namespace App\Discount;

use App\Discount\AbstractDiscount;
use App\Service\DTO\PriceEnquiryInterface;
use App\Repository\EarlyBookingRangeRuleRepository;

class EarlyBookingDiscount extends AbstractDiscount
{
    public function __construct(
        private EarlyBookingRangeRuleRepository $earlyBookingRangeRuleRepository
    ) {
    }

    public function apply(PriceEnquiryInterface $priceEnquiry): PriceEnquiryInterface
    {

        $earlyBookingRangeRules = $this->earlyBookingRangeRuleRepository->findAll();

        foreach ($earlyBookingRangeRules as $earlyBookingRangeRule) {
            $travelDate = $priceEnquiry->getTravelStart();

            $shouldBookFrom = $earlyBookingRangeRule->getBookingNormalizedDateFrom();

            $shouldBookTo = $earlyBookingRangeRule->getBookingNormalizedDateTo();

            if (
                ($shouldBookFrom && ($travelDate < $shouldBookFrom)) ||
                ($shouldBookTo && ($travelDate > $shouldBookTo))
            ) {
                continue;
            }

            $earlyBookingDiscountRules = $earlyBookingRangeRule->getEarlyBookingDiscountRules();

            foreach ($earlyBookingDiscountRules as $earlyBookingDiscountRule) {

                $paymentDate = $priceEnquiry->getPaymentDate();

                $shouldPayFrom = $earlyBookingDiscountRule->getPaymentNormalizedDateFrom();

                $shouldPayTo = $earlyBookingDiscountRule->getPaymentNormalizedDateTo();

                if (
                    !$earlyBookingDiscountRule->isActive() ||
                    !$earlyBookingDiscountRule->isValid() ||
                    ($shouldPayFrom && ($paymentDate < $shouldPayFrom)) ||
                    ($shouldPayTo && ($paymentDate > $shouldPayTo))
                ) {
                    continue;
                }

                $discountAmount = $priceEnquiry->getFinalPrice() * $earlyBookingDiscountRule->getModifier();

                $discountAmount = ($earlyBookingDiscountRule->getAmountLimit() > 0)
                    ? min($earlyBookingDiscountRule->getAmountLimit(), $discountAmount)
                    : $discountAmount;

                $finalPrice = $priceEnquiry->getFinalPrice() - $discountAmount;

                $priceEnquiry->setFinalPrice($finalPrice);

                break;
            }
        }
        return $priceEnquiry;
    }
}
