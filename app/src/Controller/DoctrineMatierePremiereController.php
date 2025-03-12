<?php

namespace App\Controller;

use App\Entity\DoctrineMatierePremiere;
use App\Form\DoctrineMatierePremiereType;
use App\Repository\DoctrineMatierePremiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class DoctrineMatierePremiereController extends AbstractController
{
    #[Route('/matiere-premiere', name: 'matiere_premiere.index', methods: ['GET'])]
    public function index(DoctrineMatierePremiereRepository $doctrineMatierePremiereRepository): Response
    {
        return $this->render('matiere_premiere/list.html.twig', [
            'doctrine_matiere_premieres' => $doctrineMatierePremiereRepository->findAll(),
        ]);
    }

    #[Route('/matiere-premiere/create', name: 'matiere_premiere.create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $doctrineMatierePremiere = new DoctrineMatierePremiere();
        $form = $this->createForm(DoctrineMatierePremiereType::class, $doctrineMatierePremiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($doctrineMatierePremiere);
            $entityManager->flush();

            return $this->redirectToRoute('matiere_premiere.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matiere_premiere/new.html.twig', [
            'doctrine_matiere_premiere' => $doctrineMatierePremiere,
            'form' => $form,
        ]);
    }

    #[Route('/matiere-premiere/{id}', name: 'matiere_premiere.show', methods: ['GET'])]
    public function show(DoctrineMatierePremiere $doctrineMatierePremiere): Response
    {
        return $this->render('matiere_premiere/show.html.twig', [
            'doctrine_matiere_premiere' => $doctrineMatierePremiere,
        ]);
    }

    #[Route('/matiere-premiere/{id}/edit', name: 'matiere_premiere.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DoctrineMatierePremiere $doctrineMatierePremiere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DoctrineMatierePremiereType::class, $doctrineMatierePremiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('matiere_premiere.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matiere_premiere/edit.html.twig', [
            'doctrine_matiere_premiere' => $doctrineMatierePremiere,
            'form' => $form,
        ]);
    }

    #[Route('/matiere-premiere/{id}', name: 'matiere_premiere.delete', methods: ['POST'])]
    public function delete(Request $request, DoctrineMatierePremiere $doctrineMatierePremiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctrineMatierePremiere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($doctrineMatierePremiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('matiere_premiere.index', [], Response::HTTP_SEE_OTHER);
    }
}
