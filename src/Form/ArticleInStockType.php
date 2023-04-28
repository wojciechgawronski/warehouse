<?php

namespace App\Form;

use App\Entity\ArticleInStock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ArticleInStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Document',
                'required'   => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => ['application/pdf'],
                    ]),
                ]
            ])
            ->add('amount', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('operation_type', ChoiceType::class, [
                'label' => 'Operation type',
                'constraints' => [
                    new NotBlank()
                ],
                'choices' => [
                    'add' => 'add',
                    'remove' => 'remove',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleInStock::class,
        ]);
    }
}
