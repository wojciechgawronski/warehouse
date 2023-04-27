<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleInStock;
use App\Form\ArticleInStockType;
use App\Repository\ArticleInStockRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/article/{article}')]
class ArticleInStockController extends AbstractController
{
    #[Route('/article-in-stock/', name: 'app_article_in_stock_index', methods: ['GET'])]
    public function index(Article $article, ArticleInStockRepository $articleInStockRepository): Response
    {
        return $this->render('article_in_stock/index.html.twig', [
            'article_in_stocks' => $articleInStockRepository->findAll(),
            'article' => $article,
        ]);
    }

    #[Route('/article-in-stock/new', name: 'app_article_in_stock_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Article $article,  ArticleInStockRepository $articleInStockRepository): Response
    {
        $articleInStock = new ArticleInStock();
        $form = $this->createForm(ArticleInStockType::class, $articleInStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleInStock->setCreatedAt(new DateTimeImmutable('now'));
            $articleInStock->setCreatedBy($this->getUser());
            $articleInStock->setArticle($article);

            $articleInStockRepository->save($articleInStock, true);

            return $this->redirectToRoute('app_article_show', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_in_stock/new.html.twig', [
            'article_in_stock' => $articleInStock,
            'form' => $form,
            'article' => $article
        ]);
    }

    #[Route('/article-in-stock/{id}', name: 'app_article_in_stock_show', methods: ['GET'])]
    public function show(Article $article, ArticleInStock $articleInStock): Response
    {
        return $this->render('article_in_stock/show.html.twig', [
            'article_in_stock' => $articleInStock,
            'article' => $article
        ]);
    }

    #[Route('/article-in-stock/{id}/edit', name: 'app_article_in_stock_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, ArticleInStock $articleInStock, ArticleInStockRepository $articleInStockRepository): Response
    {
        $form = $this->createForm(ArticleInStockType::class, $articleInStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleInStockRepository->save($articleInStock, true);

            return $this->redirectToRoute('app_article_in_stock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_in_stock/edit.html.twig', [
            'article_in_stock' => $articleInStock,
            'form' => $form,
            'article' => $article,
        ]);
    }

    #[Route('/article-in-stock/{id}', name: 'app_article_in_stock_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, ArticleInStock $articleInStock, ArticleInStockRepository $articleInStockRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleInStock->getId(), $request->request->get('_token'))) {
            $articleInStockRepository->remove($articleInStock, true);
        }

        return $this->redirectToRoute('app_article_show', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
    }
}
