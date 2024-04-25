<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TravelPriceCalculator;
use App\Service\DTO\TravelPriceEnquiry;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\Validator\TravelPriceEnquiryValidator;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CalculateTravelController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private TravelPriceCalculator $travelPriceCalculator,
        private TravelPriceEnquiryValidator $priceEnquiryValidator
    ) {
    }

    //я выбрала GET в соответствие с RESTful, но наверное для приватного API будет удобнее и POST 
    #[Route('/calculate-travel', name: 'calculate_travel', methods: ['GET'])]
    public function calculatePrice(#[MapQueryString] TravelPriceEnquiry $travelPriceEnquiry): JsonResponse
    {
        $this->priceEnquiryValidator->validate($travelPriceEnquiry);

        $responseContent = $this->serializer->serialize(
            $this->travelPriceCalculator->calculate($travelPriceEnquiry),
            'json'
        );

        return new JsonResponse($responseContent);
    }
}
