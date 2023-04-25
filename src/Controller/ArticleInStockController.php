<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleInStock;
use App\Form\ArticleInStockType;
use App\Repository\ArticleInStockRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/article/{article}')]
class ArticleInStockController extends AbstractController
{
    #[Route('/article-in-stock/', name: 'app_article_in_stock_index', methods: ['GET'])]
    public function index(ArticleInStockRepository $articleInStockRepository): Response
    {
        return $this->render('article_in_stock/index.html.twig', [
            'article_in_stocks' => $articleInStockRepository->findAll(),
        ]);
    }

    #[Route('/article-in-stock/new', name: 'app_article_in_stock_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArticleRepository $articleRepository,  ArticleInStockRepository $articleInStockRepository): Response
    {
        $article = new Article();
        $request->query->get('article');
        dd($request->query->get('article'));
        dd($article);
        $request->query->get('id');
        $articleInStock = new ArticleInStock();
        $form = $this->createForm(ArticleInStockType::class, $articleInStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleInStockRepository->save($articleInStock, true);

            return $this->redirectToRoute('app_article_in_stock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_in_stock/new.html.twig', [
            'article_in_stock' => $articleInStock,
            'form' => $form,
            'article' => $article
        ]);
    }

    #[Route('/article-in-stock/{id}', name: 'app_article_in_stock_show', methods: ['GET'])]
    public function show(ArticleInStock $articleInStock): Response
    {
        return $this->render('article_in_stock/show.html.twig', [
            'article_in_stock' => $articleInStock,
        ]);
    }

    #[Route('/article-in-stock/{id}/edit', name: 'app_article_in_stock_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ArticleInStock $articleInStock, ArticleInStockRepository $articleInStockRepository): Response
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
        ]);
    }

    #[Route('/article-in-stock/{id}', name: 'app_article_in_stock_delete', methods: ['POST'])]
    public function delete(Request $request, ArticleInStock $articleInStock, ArticleInStockRepository $articleInStockRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleInStock->getId(), $request->request->get('_token'))) {
            $articleInStockRepository->remove($articleInStock, true);
        }

        return $this->redirectToRoute('app_article_in_stock_index', [], Response::HTTP_SEE_OTHER);
    }
}
