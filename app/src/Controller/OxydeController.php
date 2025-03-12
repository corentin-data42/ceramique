<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OxydeRepository;
use App\Entity\Oxyde;
use App\Form\OxydeType;

final class OxydeController extends AbstractController
{
    #[Route('/oxyde', name: 'oxyde.index')]
    public function index(OxydeRepository $repository): Response
    {
        $oxydes = $repository->findAll();
        return $this->render('oxyde/index.html.twig',[
            'oxydes'=>$oxydes
        ]);
    }

    #[Route('/oxyde/create', name: 'oxyde.create')]
    public function create(Request $request, EntityManagerInterface $em): Response {
        $oxyde = new Oxyde();
        $form = $this->createForm(OxydeType::class,$oxyde);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()){
            
           
            $em->persist($oxyde);
            $em->flush();
            $this->addFlash('success','l\'oxyde a bien été créé');
            return $this->redirectToRoute('oxyde.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('error','l\'oxyde n\'a pas été créé');
        }
        return $this->render("oxyde/create.html.twig",[
            "form"=>$form
        ]);
    }

    #[Route('/oxyde/{id}', name: 'oxyde.show', requirements:['id'=>'\d+'])]
    public function show(Request $request, int $id): Response
    {
        return $this->render('oxyde/show.html.twig',['id'=>$id]);
    }

    #[Route("/oxyde/{id}/edit",name:"oxyde.edit", requirements:['id'=>'\d+'], methods:['POST','GET'])]
    public function edit(Oxyde $oxyde, Request $request, EntityManagerInterface $em): Response {
        
        $form = $this->createForm(OxydeType::class,$oxyde);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success','l\'oxyde a bien été modifié');
            return $this->redirectToRoute('oxyde.index');
        }elseif($form->isSubmitted()){
            $this->addFlash('error','l\'oxyde n\'a pas été modifié');
        }
        return $this->render("oxyde/edit.html.twig",[
            "oxyde"=>$oxyde,
            "form"=>$form
        ]);
    }

    #[Route('/oxyde/{id}/remove', name: 'oxyde.remove', requirements:['id'=>'\d+'], methods:['DELETE'])]
    public function remove(Oxyde $oxyde, EntityManagerInterface $em): Response
    {
        $em->remove($oxyde);
        $em->flush();
        $this->addFlash('success','l\'oxyde a bien été supprimé');
        return $this->redirectToRoute('oxyde.index');
    }
}
