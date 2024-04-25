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
        $currentYear = (new \DateTime())->format("Y");

        //print_r($priceEnquiry);

        $travelDate = $priceEnquiry->getTravelStart();
        $travelDateMonth = substr($priceEnquiry->getTravelStart(), 5);
        $travelDateYear = (int)substr($priceEnquiry->getTravelStart(), 0, 4);

        $paymentDate = $priceEnquiry->getPaymentDate();

        if (!$paymentDate || ($paymentDate >= $travelDate)) {
            return $priceEnquiry;
        }

        $paymentDateMonth = substr($priceEnquiry->getPaymentDate(), 5);
        $paymentDateYear = (int)substr($priceEnquiry->getPaymentDate(), 0, 4);

        //echo "<br><br>travelDateMonth: $travelDateMonth; paymentDateMonth: $paymentDateMonth;<br>";

        $earlyBookingRangeRules = $this->earlyBookingRangeRuleRepository->findAll();

        foreach ($earlyBookingRangeRules as $earlyBookingRangeRule) {

            $shouldBookFrom = $earlyBookingRangeRule->getBookingDateFrom();

            $shouldBookFromNextYear = $earlyBookingRangeRule->getIsBookingYearFromNext();

            $shouldBookTo = $earlyBookingRangeRule->getBookingDateTo();

            //echo "shouldBookFrom: $shouldBookFrom; shouldBookTo: $shouldBookTo;<br>";

            if ($shouldBookFromNextYear && ((int)$travelDateYear <= (int)$currentYear)) {
                continue;
            }

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

                //echo "shouldPayFrom: $shouldPayFrom; shouldPayTo: $shouldPayTo;<br><br>";

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

                //echo "1. discountAmount: $discountAmount<br>";

                $discountAmount = ($earlyBookingDiscountRule->getAmountLimit() > 0)
                    ? min($earlyBookingDiscountRule->getAmountLimit(), $discountAmount)
                    : $discountAmount;

                //echo "2. discountAmount: $discountAmount<br>";

                $finalPrice = $priceEnquiry->getFinalPrice() - $discountAmount;

                $priceEnquiry->setFinalPrice($finalPrice);

                //echo "finalPrice: $finalPrice<br>";

                return $priceEnquiry;
            }
        }
        return $priceEnquiry;
    }
}
