<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
class HomeControllerTest extends WebTestCase{

    public function test_homePage(){
        $client = static::createClient();
        $client->request("GET","/");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

    }

    public function test_h1HomePage(){
        $client = static::createClient();
        $client->request("GET","/");
        $this->assertSelectorTextContains('h1','Bienvenue');
    }

    public function test_authPageIsRestricted(){
        $client = static::createClient();
        $client->request("GET","/auth");
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
    // public function test_redirectToLogin(){
    //     $client = static::createClient();
    //     $client->request("GET","/auth");
    //     $this->assertResponseRedirects("/login");
    // }
    /** cree User et make:auth */
}
?>