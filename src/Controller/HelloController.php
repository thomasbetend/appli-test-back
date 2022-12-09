<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/', name: 'hello')]

    public function hello(): Response
    {
        $name = "Thomas";
        return $this->render('hello.html.twig', ['name' => $name]);
    }
}