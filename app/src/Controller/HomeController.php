<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        //return new Response('<html><body>'.phpinfo().'</body></html>');
        return $this->render('home/index.html.twig', [
            
        ]);
    }


    #[Route('/auth', name: 'auth')]
    #[IsGranted("ROLE_USER")]
    public function auth(): Response
    {
        //return new Response('<html><body>'.phpinfo().'</body></html>');
        return $this->render('home/index.html.twig', [
        ]);
    }
}
