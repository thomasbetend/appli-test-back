<?php

namespace App\Controller;

use App\Entity\SpecialActor;
use App\Form\SpecialActorType;
use App\Repository\SpecialActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/special/actor')]
class SpecialActorController extends AbstractController
{
    #[Route('/', name: 'app_special_actor_index', methods: ['GET'])]
    public function index(SpecialActorRepository $specialActorRepository): Response
    {
        return $this->render('special_actor/index.html.twig', [
            'special_actors' => $specialActorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_special_actor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SpecialActorRepository $specialActorRepository): Response
    {
        $specialActor = new SpecialActor();
        $form = $this->createForm(SpecialActorType::class, $specialActor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialActorRepository->save($specialActor, true);

            return $this->redirectToRoute('app_special_actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('special_actor/new.html.twig', [
            'special_actor' => $specialActor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_special_actor_show', methods: ['GET'])]
    public function show(SpecialActor $specialActor): Response
    {
        return $this->render('special_actor/show.html.twig', [
            'special_actor' => $specialActor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_special_actor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SpecialActor $specialActor, SpecialActorRepository $specialActorRepository): Response
    {
        $form = $this->createForm(SpecialActorType::class, $specialActor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialActorRepository->save($specialActor, true);

            return $this->redirectToRoute('app_special_actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('special_actor/edit.html.twig', [
            'special_actor' => $specialActor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_special_actor_delete', methods: ['POST'])]
    public function delete(Request $request, SpecialActor $specialActor, SpecialActorRepository $specialActorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialActor->getId(), $request->request->get('_token'))) {
            $specialActorRepository->remove($specialActor, true);
        }

        return $this->redirectToRoute('app_special_actor_index', [], Response::HTTP_SEE_OTHER);
    }
}
