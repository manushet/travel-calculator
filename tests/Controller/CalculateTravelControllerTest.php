<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculateTravelControllerTest extends WebTestCase
{
    public function testCalculatePrice(): void
    {
        $client = static::createClient();

        $data = [
            'base_price' => 100,
            'participant_birthday' => '2000-01-01',
            'travel_start' => '2024-05-01',
            'payment_date' => '2024-04-01'
        ];

        $client->request('POST', '/calculate-price', [], [], [], json_encode($data));

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString('{"final_price":90}', $client->getResponse()->getContent());
    }
}
