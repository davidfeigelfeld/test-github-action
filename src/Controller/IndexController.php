<?php

namespace App\Controller;

use App\Repository\ArticleRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route(path: "/", name: "app_homepage")]
class IndexController
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        private Environment $twig
    ){}

    public function __invoke(): Response
    {
        $articles = $this->articleRepository->getAll();
        return new Response($this->twig->render('index.html.twig', [ 'articles' => $articles ]));
    }
}