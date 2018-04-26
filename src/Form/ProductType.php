<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Firm;
use App\Entity\Photo;
use App\Form\PhotoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'Название',
        ])
        ->add('vendorCode', TextType::class, [
            'label' => 'Артикул',
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Описание',
        ])
        ->add('price', TextType::class, [
            'label' => 'Цена',
        ])
        ->add('category', EntityType::class, [
            'label' => 'Категория',
            'class' => Category::class,
        ])
        ->add('firm', EntityType::class, [
            'label' => 'Фирма',
            'class' => Firm::class,
        ])
        ->add('colors', EntityType::class, [
            'label' => 'Цвет',
            'expanded' => true,
            'multiple' => true,
            'class' => Color::class,
        ])
        ->add('photos', FileType::class, [
            'label' => false,
            'mapped' => false,
        ]);
    }
}
