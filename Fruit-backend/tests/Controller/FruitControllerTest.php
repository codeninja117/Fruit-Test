<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FruitControllerTest extends WebTestCase
{
    public function testGetAllFruits(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fruits');

        $this->assertResponseIsSuccessful();
        
        $response = $client->getResponse();
        $data = $response->getContent();
        $this->assertStringContainsString("Banana", $data);
    }
}
