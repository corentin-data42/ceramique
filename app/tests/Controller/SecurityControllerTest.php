<?php declare(strict_types= 1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
class SecurityControllerTest extends WebTestCase{

    function test_displayLogin(){
        $client = static::createClient();
        $client->request("GET","/login");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains("h1","Se connecter");
        $this->assertSelectorNotExists(".alert.alert-danger");
    }

    function test_loginWithBadCredentials(){
        $client = static::createClient();
        $crawler = $client->request("GET","/login");
        $form = $crawler->selectButton("Se connecter")->form([
            '_username'=>'spam@bot.fr',
            '_password'=>'br@tAl_P@Zz-08'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects("/login");
        $client->followRedirect();
        $this->assertSelectorExists(".alert.alert-danger");
    }

    function test_loginSuccessfull(){
        $client = static::createClient();
        $crawler = $client->request("GET","/login");
        $form = $crawler->selectButton("Se connecter")->form([
            '_username'=>'john@doe.fr',
            '_password'=>'br@tAl_P@Zz-08'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects("/login");
        $client->followRedirect();
        $this->assertSelectorExists(".alert.alert-danger");
    }
}
?>  