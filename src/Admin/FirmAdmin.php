<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FirmAdmin extends AbstractAdmin
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
        $formMapper->add('name', TextType::class)
            ->add('label', TextType::class)
            ->add('description', TextType::class)
//            ->add('picture', null, [ // так вроде бы можно вывести текущее изображение
//                'template' => 'adminPhoto.html.twig',
//                'mapped' => false,
//            ])
            ->add('photoFile', FileType::class, [
                'required' => false,
                'label' => 'Фото',
            ]);
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param DatagridMapper $datagridMapper
     *
     * @return void
     */
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
            ->add('updatedAt', null, [
                'label' => 'Обновлено',
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
        $listMapper->addIdentifier('name', TextType::class, [
                'label' => 'Идентификатор',
            ])
            ->add('label', TextType::class, [
                'label' => 'Название',
            ])
            ->add('description', TextType::class, [
                'label' => 'Описание',
            ]);
//            ->add('updatedAt', DateTimeType::class, [
//                'widget' => 'single_text',
//                'html5' => false,
//                'label' => 'Обновлено',
//            ]);
    }
}
