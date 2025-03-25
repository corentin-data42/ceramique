<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use App\Repository\FournisseurRepository;

use Doctrine\ORM\EntityManagerInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN', message: 'You are not allowed to access the admin dashboard.')]
final class FournisseurController extends AbstractController
{
    #[Route('/admin/fournisseur', name: 'admin.fournisseur.index')]
    public function index(FournisseurRepository $repository): Response
    {   
        $fournisseurs = $repository->findAll();
        return $this->render('admin/fournisseur/index.html.twig', [
            'fournisseurs' => $fournisseurs,
        ]);
    }
    #[Route('/admin/fournisseur/create', name: 'admin.fournisseur.create', methods:['POST','GET'])]
    public function create(Request $request, EntityManagerInterface $em): Response{
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success','Le fournisseur a bien été créé');
            return $this->redirectToRoute('admin.fournisseur.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('danger','Le fournisseur n\'a pas pu être créé');
        }
        
        return $this->render('admin/fournisseur/create.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/admin/fournisseur/{id}/edit', name: 'admin.fournisseur.edit', requirements:['id'=>'\d+'], methods:['POST','GET'])]
    public function edit(Request $request, Fournisseur $fournisseur, EntityManagerInterface $em): Response{
        
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$em->persist($form->getData());
            $em->flush();
            $this->addFlash('success','Le fournisseur a bien été modifié');
            return $this->redirectToRoute('admin.fournisseur.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('danger','Le fournisseur n\'a pas pu être modifié');
        }
        
        return $this->render('admin/fournisseur/edit.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/admin/fournisseur/{id}/show', name: 'admin.fournisseur.show', requirements:['id'=>'\d+'], methods:['GET'])]
    public function show(Fournisseur $Fournisseur): Response{
        return $this->render('admin/fournisseur/show.html.twig', [
            'fournisseur' => $Fournisseur,
        ]);
    }
    #[Route('/admin/fournisseur/{id}/remove', name: 'admin.fournisseur.remove', requirements:['id'=>'\d+'], methods:['DELETE'])]
    public function remove(Fournisseur $fournisseur, EntityManagerInterface $em): Response{
        
        $em->remove($fournisseur);
        $em->flush();
        $this->addFlash('success','le fournisseur à bien été supprimer');
        return $this->redirectToRoute('admin.fournisseur.index');
    }
}
