<?php

namespace App\Components;

use App\Entity\Article;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('articleInStockIndex')]
class ArticleInStockIndex
{
    public Article $article; 
    public $article_in_stocks;
}
