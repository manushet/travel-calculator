<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculateTravelControllerTest extends WebTestCase
{
    public function testSuccessfullJsonResponseAPI(): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/calculate-travel?basePrice=10000&participantBirthday=2000-09-09&travelStart=2025-01-10&paymentDate=2024-10-10'
        );

        $this->assertResponseIsSuccessful();

        $expectedResponseContent = json_encode("{\"basePrice\":10000,\"finalPrice\":10000.0,\"participantBirthday\":\"2000-09-09\",\"travelStart\":\"2025-01-10\",\"paymentDate\":\"2024-10-10\"}");

        $actualResponse = json_encode(json_decode($client->getResponse()->getContent()), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $this->assertJsonStringEqualsJsonString($expectedResponseContent, $actualResponse);
    }

    public function testIncorrectParticipantBirthdayFormatJsonResponseAPI(): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/calculate-travel?basePrice=1000&participantBirthday=2000&travelStart=2025-01-10&paymentDate=2024-10-10'
        );

        $this->assertResponseIsSuccessful();

        $expectedResponseContent = json_encode("{\"error\":\"Incorrect participantBirthday date format\"}");

        $actualResponse = json_encode(json_decode($client->getResponse()->getContent()), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $this->assertJsonStringEqualsJsonString($expectedResponseContent, $actualResponse);
    }

    public function testIncorrectBasePriceJsonResponseAPI(): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/calculate-travel?basePrice=efe&participantBirthday=2018-09-18&travelStart=2025-01-10&paymentDate=2024-10-10'
        );

        $this->assertResponseIsSuccessful();

        $expectedResponseContent = json_encode("{\"error\":\"Incorrect basePrice value\"}");

        $actualResponse = json_encode(json_decode($client->getResponse()->getContent()), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $this->assertJsonStringEqualsJsonString($expectedResponseContent, $actualResponse);
    }
}
