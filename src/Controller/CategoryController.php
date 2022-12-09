<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController 
{
    #[Route("/category/new", name: "category_new")]
    
    public function new(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('/category/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    #[Route('/category/', name: 'category_index')]

    public function index(CategoryRepository $categoryRepo): Response
    {
        $categories = $categoryRepo->findAll();

        return $this->render(
            'category/index.html.twig', 
            ['category' => $categories]);
    }

}