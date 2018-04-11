<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Firm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
                ->add('color', EntityType::class, [
            'label' => 'Цвет',
            'class' => Color::class,
        ])
                ->add('photo', FileType::class, [
            'label' => 'Фото',
        ]);
    }
    
    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_product';
    }
}
