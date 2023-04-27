<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('vat')
            ->add('file', FileType::class, [
                'label' => 'File | Only .pdf, max-size: 2M',
                'required'   => false,
                'constraints' => [  
                    new File([
                        'maxSize' => '2M', 
                        'mimeTypes' => ['application/pdf']
                    ]),
                ]
            ])
            ->add('unitPrice')
            ->add('unitMeasurment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new UniqueEntity([
                    'entityClass' => Article::class,
                    'fields' => 'name',
                ])
            ],
            'data_class' => Article::class,
        ]);
    }
}
