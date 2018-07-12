<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PhotoAdmin extends AbstractAdmin
{

    /**
     * Конфигурация формы редактирования записи
     *
     * @param FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('photo', FileType::class, [
            'label' => false,
            'mapped' => false,
        ])
        ->add('photoDescription', TextType::class, [
            'attr' => [
                'placeholder' => 'Введите описание фото',
            ],
            'label' => false,
            'mapped' => false,
        ]);
    }

    /**
     * Конфигурация списка записей
     *
     * @param ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('photo', FileType::class, [
            'label' => false,
            'mapped' => false,
        ])
        ->add('photoDescription', TextType::class, [
            'attr' => [
                'placeholder' => 'Введите описание фото',
            ],
            'label' => false,
            'mapped' => false,
        ]);
    }
}
