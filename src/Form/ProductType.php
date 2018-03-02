<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
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
                ->add('category', ChoiceType::class, [
            'label' => 'Категория',
        ])
                ->add('firm', ChoiceType::class, [
            'label' => 'Фирма',
        ])
                ->add('colors', ChoiceType::class, [
            'label' => 'Цвет',
        ])
                ->add('photos', FileType::class, [
            'label' => 'Фото',
        ]);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Product'
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
