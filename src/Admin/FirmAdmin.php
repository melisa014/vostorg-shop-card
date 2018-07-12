<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FirmAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class)
            ->add('label', TextType::class)
            ->add('description', TextType::class)
            ->add('pathToPhoto', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name', null, [
                'label' => 'Идентификатор',
            ])
            ->add('label', null, [
                'label' => 'Название',
            ])
            ->add('description', null, [
                'label' => 'Описание',
            ])
            ->add('pathToPhoto', null, [
                'label' => 'Фото',
            ])
            ->add('updatedAt', null, [
                'label' => 'Обновлено',
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', TextType::class, [
                'label' => 'Идентификатор',
            ])
            ->add('label', TextType::class, [
                'label' => 'Название',
            ])
            ->add('description', TextType::class, [
                'label' => 'Описание',
            ])
            ->add('pathToPhoto', TextType::class, [
                'label' => 'Фото',
            ]);
//            ->add('updatedAt', DateTimeType::class, [
//                'widget' => 'single_text',
//                'html5' => false,
//                'label' => 'Обновлено',
//            ]);
    }
}
