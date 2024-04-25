<?php

declare(strict_types=1);

namespace App\Tests;

use App\Tests\ServiceTestCase;
use App\Service\DTO\TravelPriceEnquiry;
use App\Service\TravelPriceCalculator;

class TravelPriceCalculatorTest extends ServiceTestCase
{

    public function testTravelPriceCalculateWithAgeUnder3(): void
    {
        $travelPriceCalculator = $this->container->get(TravelPriceCalculator::class);

        $travelPriceEnquiry = new TravelPriceEnquiry(
            50000,
            '2024-09-17',
            '2025-07-20',
            '2024-12-06'
        );

        $expectedFinalPrice = (float)48500;

        $finalPriceEnquiry = $travelPriceCalculator->calculate($travelPriceEnquiry);

        $this->assertSame($travelPriceEnquiry->getBasePrice(), $finalPriceEnquiry->getBasePrice());
        $this->assertSame($travelPriceEnquiry->getTravelStart(), $finalPriceEnquiry->getTravelStart());
        $this->assertSame($travelPriceEnquiry->getPaymentDate(), $finalPriceEnquiry->getPaymentDate());
        $this->assertSame($travelPriceEnquiry->getParticipantBirthday(), $finalPriceEnquiry->getParticipantBirthday());
        $this->assertSame($expectedFinalPrice, $finalPriceEnquiry->getFinalPrice());
    }

    public function testTravelPriceCalculateWithAgeFrom3To6(): void
    {
        $travelPriceCalculator = $this->container->get(TravelPriceCalculator::class);

        $travelPriceEnquiry = new TravelPriceEnquiry(
            50000,
            '2023-09-17',
            '2027-05-01',
            '2026-05-06'
        );

        $expectedFinalPrice = (float)9300;

        $finalPriceEnquiry = $travelPriceCalculator->calculate($travelPriceEnquiry);

        $this->assertSame($travelPriceEnquiry->getBasePrice(), $finalPriceEnquiry->getBasePrice());
        $this->assertSame($travelPriceEnquiry->getTravelStart(), $finalPriceEnquiry->getTravelStart());
        $this->assertSame($travelPriceEnquiry->getPaymentDate(), $finalPriceEnquiry->getPaymentDate());
        $this->assertSame($travelPriceEnquiry->getParticipantBirthday(), $finalPriceEnquiry->getParticipantBirthday());
        $this->assertSame($expectedFinalPrice, $finalPriceEnquiry->getFinalPrice());
    }

    public function testTravelPriceCalculateWithAgeFrom6To12(): void
    {
        $travelPriceCalculator = $this->container->get(TravelPriceCalculator::class);

        $travelPriceEnquiry = new TravelPriceEnquiry(
            50000,
            '2018-09-17',
            '2026-08-15',
            '2024-09-10'
        );

        $expectedFinalPrice = (float)44000;

        $finalPriceEnquiry = $travelPriceCalculator->calculate($travelPriceEnquiry);

        $this->assertSame($travelPriceEnquiry->getBasePrice(), $finalPriceEnquiry->getBasePrice());
        $this->assertSame($travelPriceEnquiry->getTravelStart(), $finalPriceEnquiry->getTravelStart());
        $this->assertSame($travelPriceEnquiry->getPaymentDate(), $finalPriceEnquiry->getPaymentDate());
        $this->assertSame($travelPriceEnquiry->getParticipantBirthday(), $finalPriceEnquiry->getParticipantBirthday());
        $this->assertSame($expectedFinalPrice, $finalPriceEnquiry->getFinalPrice());
    }

    public function testTravelPriceCalculateWithAgeFrom12To18(): void
    {
        $travelPriceCalculator = $this->container->get(TravelPriceCalculator::class);

        $travelPriceEnquiry = new TravelPriceEnquiry(
            50000,
            '2010-09-17',
            '2027-01-05',
            '2025-10-05'
        );

        $expectedFinalPrice = (float)43500;

        $finalPriceEnquiry = $travelPriceCalculator->calculate($travelPriceEnquiry);

        $this->assertSame($travelPriceEnquiry->getBasePrice(), $finalPriceEnquiry->getBasePrice());
        $this->assertSame($travelPriceEnquiry->getTravelStart(), $finalPriceEnquiry->getTravelStart());
        $this->assertSame($travelPriceEnquiry->getPaymentDate(), $finalPriceEnquiry->getPaymentDate());
        $this->assertSame($travelPriceEnquiry->getParticipantBirthday(), $finalPriceEnquiry->getParticipantBirthday());
        $this->assertSame($expectedFinalPrice, $finalPriceEnquiry->getFinalPrice());
    }

    public function testTravelPriceCalculateWithAgeOver18(): void
    {
        $travelPriceCalculator = $this->container->get(TravelPriceCalculator::class);

        $travelPriceEnquiry = new TravelPriceEnquiry(
            50000,
            '2000-09-17',
            '2025-01-25',
            '2024-10-05'
        );

        $expectedFinalPrice = (float)48500;

        $finalPriceEnquiry = $travelPriceCalculator->calculate($travelPriceEnquiry);

        $this->assertSame($travelPriceEnquiry->getBasePrice(), $finalPriceEnquiry->getBasePrice());
        $this->assertSame($travelPriceEnquiry->getTravelStart(), $finalPriceEnquiry->getTravelStart());
        $this->assertSame($travelPriceEnquiry->getPaymentDate(), $finalPriceEnquiry->getPaymentDate());
        $this->assertSame($travelPriceEnquiry->getParticipantBirthday(), $finalPriceEnquiry->getParticipantBirthday());
        $this->assertSame($expectedFinalPrice, $finalPriceEnquiry->getFinalPrice());
    }

    public function testTravelPriceCalculateWithOverduePaymentDate(): void
    {
        $travelPriceCalculator = $this->container->get(TravelPriceCalculator::class);

        $travelPriceEnquiry = new TravelPriceEnquiry(
            50000,
            '2005-09-17',
            '2025-01-25',
            '2024-12-05'
        );

        $expectedFinalPrice = (float)50000;

        $finalPriceEnquiry = $travelPriceCalculator->calculate($travelPriceEnquiry);

        $this->assertSame($travelPriceEnquiry->getBasePrice(), $finalPriceEnquiry->getBasePrice());
        $this->assertSame($travelPriceEnquiry->getTravelStart(), $finalPriceEnquiry->getTravelStart());
        $this->assertSame($travelPriceEnquiry->getPaymentDate(), $finalPriceEnquiry->getPaymentDate());
        $this->assertSame($travelPriceEnquiry->getParticipantBirthday(), $finalPriceEnquiry->getParticipantBirthday());
        $this->assertSame($expectedFinalPrice, $finalPriceEnquiry->getFinalPrice());
    }

    public function testTravelPriceCalculateWithLatePaymentDate(): void
    {
        $travelPriceCalculator = $this->container->get(TravelPriceCalculator::class);

        $travelPriceEnquiry = new TravelPriceEnquiry(
            50000,
            '2005-09-17',
            '2024-10-21',
            '2024-12-11'
        );

        $expectedFinalPrice = (float)50000;

        $finalPriceEnquiry = $travelPriceCalculator->calculate($travelPriceEnquiry);

        $this->assertSame($travelPriceEnquiry->getBasePrice(), $finalPriceEnquiry->getBasePrice());
        $this->assertSame($travelPriceEnquiry->getTravelStart(), $finalPriceEnquiry->getTravelStart());
        $this->assertSame($travelPriceEnquiry->getPaymentDate(), $finalPriceEnquiry->getPaymentDate());
        $this->assertSame($travelPriceEnquiry->getParticipantBirthday(), $finalPriceEnquiry->getParticipantBirthday());
        $this->assertSame($expectedFinalPrice, $finalPriceEnquiry->getFinalPrice());
    }
}
