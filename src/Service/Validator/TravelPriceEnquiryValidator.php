<?php

declare(strict_types=1);

namespace App\Service\Validator;

use App\Service\DTO\PriceEnquiryInterface;
use App\Exception\InvalidEnquiryParametersException;

class TravelPriceEnquiryValidator
{

    public function validate(PriceEnquiryInterface $priceEnquiry): void
    {
        $errMsg = [];

        if (!$priceEnquiry->getBasePrice()) {
            $errMsg[] = 'Invalid Base Price value.';
        }

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $priceEnquiry->getParticipantBirthday())) {
            $errMsg[] = 'Invalid Participant Birthday date format.';
        }

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $priceEnquiry->getTravelStart())) {
            $errMsg[] = 'Invalid Travel Start date format.';
        }

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $priceEnquiry->getPaymentDate())) {
            $errMsg[] = 'Invalid Payment Date date format.';
        }

        if (count($errMsg) > 0) {
            throw new InvalidEnquiryParametersException(implode(" ", $errMsg));
        }
    }
}
