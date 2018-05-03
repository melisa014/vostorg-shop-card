<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PhotoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('photo', FileType::class, [
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control'
                    ],
                ])
                ->add('photoDescription', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Введите описание фото',
                        'class' => 'form-control'
                    ],
                    'label' => false,
                ]);
    }
}
