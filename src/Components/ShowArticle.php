<?php

namespace App\Components;

use App\Entity\Article;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('showArticle')]
class ShowArticle
{
    public Article $article; 
}
