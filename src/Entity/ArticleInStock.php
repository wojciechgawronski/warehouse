<?php

namespace App\Entity;

use App\Repository\ArticleInStockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleInStockRepository::class)]
class ArticleInStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articleInStocks')]
    private ?Article $article = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $remaining_amount = null;

    #[ORM\Column(length: 255)]
    private ?string $article_operation_type = null;

    #[ORM\ManyToOne(inversedBy: 'articleInStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $created_by = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getRemainingAmount(): ?string
    {
        return $this->remaining_amount;
    }

    public function setRemainingAmount(string $remaining_amount): self
    {
        $this->remaining_amount = $remaining_amount;

        return $this;
    }

    public function getArticleOperationType(): ?string
    {
        return $this->article_operation_type;
    }

    public function setArticleOperationType(string $article_operation_type): self
    {
        $this->article_operation_type = $article_operation_type;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }
}
