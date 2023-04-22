<?php

namespace App\Form;

use App\Entity\ArticleInStock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleInStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file')
            ->add('created_at')
            ->add('amount')
            ->add('remaining_amount')
            ->add('article_operation_type')
            ->add('article')
            ->add('created_by')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleInStock::class,
        ]);
    }
}
