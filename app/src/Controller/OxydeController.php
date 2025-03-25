<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OxydeRepository;
use App\Entity\Oxyde;
use App\Form\OxydeType;
use Symfony\Component\Security\Http\Attribute\IsGranted;
#[IsGranted('ROLE_ADMIN', message: 'You are not allowed to access the admin dashboard.')]
final class OxydeController extends AbstractController
{
    #[Route('/admin/oxyde', name: 'admin.oxyde.index')]
    public function index(OxydeRepository $repository): Response
    {
        $oxydes = $repository->findAll();
        return $this->render('admin/oxyde/index.html.twig',[
            'oxydes'=>$oxydes
        ]);
    }

    #[Route('/admin/admin/oxyde/create', name: 'admin.oxyde.create')]
    public function create(Request $request, EntityManagerInterface $em): Response {
        $oxyde = new Oxyde();
        $form = $this->createForm(OxydeType::class,$oxyde);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            
            $em->persist($oxyde);
            $em->flush();
            $this->addFlash('success','l\'oxyde a bien été créé');
            return $this->redirectToRoute('admin.oxyde.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('error','l\'oxyde n\'a pas été créé');
        }
        return $this->render("admin/oxyde/create.html.twig",[
            "form"=>$form
        ]);
    }

    #[Route('/admin/oxyde/{id}', name: 'admin.oxyde.show', requirements:['id'=>'\d+'])]
    public function show(Request $request, int $id): Response
    {
        return $this->render('oxyde/show.html.twig',['id'=>$id]);
    }

    #[Route("/admin/oxyde/{id}/edit",name:"admin.oxyde.edit", requirements:['id'=>'\d+'], methods:['POST','GET'])]
    public function edit(Oxyde $oxyde, Request $request, EntityManagerInterface $em): Response {
        
        $form = $this->createForm(OxydeType::class,$oxyde);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success','l\'oxyde a bien été modifié');
            return $this->redirectToRoute('admin.admin.oxyde.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('error','l\'oxyde n\'a pas été modifié');
        }
        return $this->render("admin/oxyde/edit.html.twig",[
            "oxyde"=>$oxyde,
            "form"=>$form
        ]);
    }

    #[Route('/admin/oxyde/{id}/remove', name: 'admin.oxyde.remove', requirements:['id'=>'\d+'], methods:['DELETE'])]
    public function remove(Oxyde $oxyde, EntityManagerInterface $em): Response
    {
        $em->remove($oxyde);
        $em->flush();
        $this->addFlash('success','l\'oxyde a bien été supprimé');
        return $this->redirectToRoute('admin.oxyde.index');
    }
}
