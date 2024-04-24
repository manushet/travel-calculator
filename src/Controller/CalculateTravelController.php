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

    #[Route('/calculate-travel', name: 'calculate_travel', methods: ['GET'])]
    public function calculatePrice(#[MapQueryString] TravelPriceEnquiry $travelPriceEnquiry): JsonResponse
    {
        try {
            $this->priceEnquiryValidator->validate($travelPriceEnquiry);

            $finalPriceEnquiry = $this->travelPriceCalculator->calculate($travelPriceEnquiry);

            $responseContent = $this->serializer->serialize($finalPriceEnquiry, 'json');

            return new JsonResponse($responseContent);
        } catch (\Exception $e) {
            $responseContent = ["error" => $e->getMessage()];

            return new JsonResponse(json_encode($responseContent));
        }
    }
}
