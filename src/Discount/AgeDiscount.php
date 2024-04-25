<?php

declare(strict_types=1);

namespace App\Discount;

use App\Discount\AbstractDiscount;
use App\Repository\AgeDiscountRuleRepository;
use App\Service\DTO\PriceEnquiryInterface;

class AgeDiscount extends AbstractDiscount
{
    public function __construct(
        private AgeDiscountRuleRepository $AgeDiscountRuleRepository
    ) {
    }

    public function apply(PriceEnquiryInterface $priceEnquiry): PriceEnquiryInterface
    {
        $ageDiscountRules = $this->AgeDiscountRuleRepository->findAll();

        $travelStartDate = new \DateTime($priceEnquiry->getTravelStart());

        $participantBirthday = new \DateTime($priceEnquiry->getParticipantBirthday());

        $participantAge = $travelStartDate->diff($participantBirthday)->y;

        foreach ($ageDiscountRules as $ageDiscountRule) {
            if (
                !$ageDiscountRule->isActive() ||
                !$ageDiscountRule->isValid() ||
                ($ageDiscountRule->getMinAgeLimit() &&
                    ($ageDiscountRule->getMinAgeLimit() > $participantAge)) ||
                ($ageDiscountRule->getMaxAgeLimit() &&
                    ($ageDiscountRule->getMaxAgeLimit() <= $participantAge))
            ) {
                continue;
            }

            $ageDiscount = $priceEnquiry->getFinalPrice() * $ageDiscountRule->getModifier();

            $ageDiscount = ($ageDiscountRule->getAmountLimit() > 0)
                ? min($ageDiscountRule->getAmountLimit(), $ageDiscount)
                : $ageDiscount;

            $finalPrice = $priceEnquiry->getFinalPrice() - $ageDiscount;

            $priceEnquiry->setFinalPrice($finalPrice);

            break;
        };

        return parent::apply($priceEnquiry);
    }
}
