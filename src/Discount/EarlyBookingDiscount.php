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

        $travelDate = $priceEnquiry->getTravelStart();
        $travelDateMonth = substr($priceEnquiry->getTravelStart(), 5);
        $travelDateYear = (int)substr($priceEnquiry->getTravelStart(), 0, 4);

        $paymentDate = $priceEnquiry->getPaymentDate();
        $paymentDateMonth = substr($priceEnquiry->getPaymentDate(), 5);
        $paymentDateYear = (int)substr($priceEnquiry->getPaymentDate(), 0, 4);

        if ($paymentDate >= $travelDate) {
            return $priceEnquiry;
        }

        $earlyBookingRangeRules = $this->earlyBookingRangeRuleRepository->findAll();

        foreach ($earlyBookingRangeRules as $earlyBookingRangeRule) {

            $shouldBookFrom = $earlyBookingRangeRule->getBookingDateFrom();

            $shouldBookTo = $earlyBookingRangeRule->getBookingDateTo();

            if ($shouldBookTo) {
                if ($shouldBookTo < $shouldBookFrom) {
                    if (($travelDateMonth < $shouldBookFrom) && ($travelDateMonth > $shouldBookTo)) {
                        continue;
                    }
                } else {
                    if (($travelDateMonth < $shouldBookFrom) || ($travelDateMonth > $shouldBookTo)) {
                        continue;
                    }
                }
            } else {
                if ($travelDateMonth < $shouldBookFrom) {
                    continue;
                }
            }

            $earlyBookingDiscountRules = $earlyBookingRangeRule->getEarlyBookingDiscountRules();

            foreach ($earlyBookingDiscountRules as $earlyBookingDiscountRule) {

                if (!$earlyBookingDiscountRule->isActive() || !$earlyBookingDiscountRule->isValid()) {
                    continue;
                }

                $shouldPayFrom = $earlyBookingDiscountRule->getPaymentDateFrom();

                $shouldPayTo = $earlyBookingDiscountRule->getPaymentDateTo();

                if ($shouldPayFrom) {
                    if ($shouldPayTo < $shouldPayFrom) {
                        if (($paymentDateMonth < $shouldPayFrom) && ($paymentDateMonth > $shouldPayTo)) {
                            continue;
                        }
                    } else {
                        if (($paymentDateMonth < $shouldPayFrom) || ($paymentDateMonth > $shouldPayTo)) {
                            continue;
                        }
                    }
                } else {
                    if ((($travelDateYear - $paymentDateYear) <= 1) && ($paymentDateMonth > $shouldPayTo)) {
                        continue;
                    }
                }

                $discountAmount = $priceEnquiry->getFinalPrice() * $earlyBookingDiscountRule->getModifier();

                $discountAmount = ($earlyBookingDiscountRule->getAmountLimit() > 0)
                    ? min($earlyBookingDiscountRule->getAmountLimit(), $discountAmount)
                    : $discountAmount;

                $priceEnquiry->setFinalPrice($priceEnquiry->getFinalPrice() - $discountAmount);

                return $priceEnquiry;
            }
        }
        return $priceEnquiry;
    }
}
