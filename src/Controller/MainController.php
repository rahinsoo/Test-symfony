<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{

    public function __construct(
        private readonly BlogRepository $blogs,
    ) {}

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {

        $articles = $this->blogs->findAll();

        return $this->render('main/index.html.twig', [
            "articles" => $articles,
        ]);
    }
}
