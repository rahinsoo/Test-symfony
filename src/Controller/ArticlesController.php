<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticlesController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    )
    {
    }

    #[Route('/articles', name: 'app_articles')]
    public function index(Request $request): Response
    {
        $article = new Blog();

        $form = $this->createForm(BlogsType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $article->setAuthor($this->getUser());
            $this->em->persist($article);
            $this->em->flush();
        }

        return $this->render('articles/index.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
}
