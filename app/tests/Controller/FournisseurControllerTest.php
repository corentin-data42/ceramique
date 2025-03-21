<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FournisseurControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/fournisseur');
        self::assertResponseIsSuccessful();
    }
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/fournisseur/create');
        self::assertResponseIsSuccessful();
    }
    public function testEdit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/fournisseur/1/edit');
        self::assertResponseIsSuccessful();
    }
    public function testShow(): void
    {
        $client = static::createClient();
        $client->request('GET', '/fournisseur/1/show');
        self::assertResponseIsSuccessful();
    }
    public function testRemove(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/fournisseur/1/remove');
        self::assertResponseIsSuccessful();
    }
}
