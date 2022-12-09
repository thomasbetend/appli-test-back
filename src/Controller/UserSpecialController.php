<?php

namespace App\Controller;

use App\Entity\UserSpecial;
use App\Form\UserSpecialType;
use App\Repository\UserSpecialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/special')]
class UserSpecialController extends AbstractController
{
    #[Route('/', name: 'app_user_special_index', methods: ['GET'])]
    public function index(UserSpecialRepository $userSpecialRepository): Response
    {
        return $this->render('user_special/index.html.twig', [
            'user_specials' => $userSpecialRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_special_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserSpecialRepository $userSpecialRepository): Response
    {
        $userSpecial = new UserSpecial();
        $form = $this->createForm(UserSpecialType::class, $userSpecial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userSpecialRepository->save($userSpecial, true);

            return $this->redirectToRoute('app_user_special_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_special/new.html.twig', [
            'user_special' => $userSpecial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_special_show', methods: ['GET'])]
    public function show(UserSpecial $userSpecial): Response
    {
        return $this->render('user_special/show.html.twig', [
            'user_special' => $userSpecial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_special_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserSpecial $userSpecial, UserSpecialRepository $userSpecialRepository): Response
    {
        $form = $this->createForm(UserSpecialType::class, $userSpecial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userSpecialRepository->save($userSpecial, true);

            return $this->redirectToRoute('app_user_special_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_special/edit.html.twig', [
            'user_special' => $userSpecial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_special_delete', methods: ['POST'])]
    public function delete(Request $request, UserSpecial $userSpecial, UserSpecialRepository $userSpecialRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userSpecial->getId(), $request->request->get('_token'))) {
            $userSpecialRepository->remove($userSpecial, true);
        }

        return $this->redirectToRoute('app_user_special_index', [], Response::HTTP_SEE_OTHER);
    }
}
