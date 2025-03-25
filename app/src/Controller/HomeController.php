<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher ): Response
    {
        
        //return new Response('<html><body>'.phpinfo().'</body></html>');
        return $this->render('home/index.html.twig', [
            
        ]);
    }


    #[Route('/admin', name: 'admin')]
    #[IsGranted("ROLE_ADMIN")]
    public function admin(): Response
    {
        //return new Response('<html><body>'.phpinfo().'</body></html>');
        return $this->render('admin/index.html.twig', [
        ]);
    }
}
