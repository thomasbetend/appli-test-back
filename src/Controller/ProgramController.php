<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]

    public function index(ProgramRepository $programRepo): Response
    {
        $programs = $programRepo->findAll();

        return $this->render(
            'program/index.html.twig', 
            ['programs' => $programs]);
    }

    #[Route('/program/new', name: 'program_new')]

    public function new(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $program = new Program();

        $form = $this->createForm(ProgramType::class, $program);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $entityManager->persist($program);
            $entityManager->flush();

            return $this->redirectToRoute('program_index');
        }

        return $this->render('/program/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]

    public function show(int $id, ProgramRepository $programRepo): Response
    {
        $program = $programRepo->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException('No program with id: ' . $id . ' found in program\'s table');
        }
        
        return $this->render(
            'program/show.html.twig', 
            ['program' => $program]);
    }
}