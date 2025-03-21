<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

final class FournisseurControllerTest extends WebTestCase
{

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
        
    private $testClient = null;
    public function setUp(): void
    {//
        $this->testClient = static::createClient([],['HTTP_HOST'=>$_ENV['HTTP_HOST']]);
        $this->databaseTool = $this->testClient->getContainer()->get(DatabaseToolCollection::class)->get();
    }
    public function test_index(): void
    {
        //$client = static::createClient();
        $this->testClient->request('GET', '/fournisseur');
        self::assertResponseIsSuccessful();
    }
    // public function test_create(): void
    // {
    //     //$client = static::createClient();
    //     $this->testClient->request('GET', '/fournisseur/create');
    //     self::assertResponseIsSuccessful();
    // }
    // public function test_edit(): void
    // {
    //     //$client = static::createClient();
    //     $this->testClient->request('GET', '/fournisseur/1/edit');
    //     self::assertResponseIsSuccessful();
    // }
    // public function test_show(): void
    // {
    //     //$client = static::createClient();
    //     $this->testClient->request('GET', '/fournisseur/1/edit',['id'=>1],);
    //     self::assertResponseIsSuccessful();
    // }
    // public function test_remove(): void
    // {
    //     //$client = static::createClient();
    //     $this->testClient->request('DELETE', '/fournisseur/20/remove');
    //     self::assertResponseIsSuccessful();
    // }
}
