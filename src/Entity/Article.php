<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $amountInStock = null;

    #[ORM\Column(nullable: true)]
    private ?int $vat = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $unitPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $unitMeasurment = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleInStock::class)]
    private Collection $articleInStocks;

    public function __construct()
    {
        $this->articleInStocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAmountInStock(): ?string
    {
        return $this->amountInStock;
    }

    public function setAmountInStock(string $amountInStock): self
    {
        $this->amountInStock = $amountInStock;

        return $this;
    }

    public function getVat(): ?int
    {
        return $this->vat;
    }

    public function setVat(?int $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(?string $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

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

    public function getUnitMeasurment(): ?string
    {
        return $this->unitMeasurment;
    }

    public function setUnitMeasurment(?string $unitMeasurment): self
    {
        $this->unitMeasurment = $unitMeasurment;

        return $this;
    }

    /**
     * @return Collection<int, ArticleInStock>
     */
    public function getArticleInStocks(): Collection
    {
        return $this->articleInStocks;
    }

    public function addArticleInStock(ArticleInStock $articleInStock): self
    {
        if (!$this->articleInStocks->contains($articleInStock)) {
            $this->articleInStocks->add($articleInStock);
            $articleInStock->setArticle($this);
        }

        return $this;
    }

    public function removeArticleInStock(ArticleInStock $articleInStock): self
    {
        if ($this->articleInStocks->removeElement($articleInStock)) {
            // set the owning side to null (unless already changed)
            if ($articleInStock->getArticle() === $this) {
                $articleInStock->setArticle(null);
            }
        }

        return $this;
    }
}
