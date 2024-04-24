<?php

declare(strict_types=1);

namespace App\Service\Validator;

use App\Service\DTO\PriceEnquiryInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TravelPriceEnquiryValidator
{

    public function validate(PriceEnquiryInterface $priceEnquiry): void
    {
        if (!$priceEnquiry->getBasePrice()) {
            throw new BadRequestHttpException('Incorrect basePrice value');
        }

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $priceEnquiry->getParticipantBirthday())) {
            throw new BadRequestHttpException('Incorrect participantBirthday date format');
        }

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $priceEnquiry->getParticipantBirthday())) {
            throw new BadRequestHttpException('Incorrect participantBirthday date format');
        }

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $priceEnquiry->getTravelStart())) {
            throw new BadRequestHttpException('Incorrect travelStart date format');
        }

        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $priceEnquiry->getPaymentDate())) {
            throw new BadRequestHttpException('Incorrect paymentDate date format');
        }
    }
}
