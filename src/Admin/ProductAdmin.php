<?php

namespace App\Admin;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Firm;
use App\Entity\Photo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;

class ProductAdmin extends AbstractAdmin
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
        $formMapper->add('name', TextType::class, [
                'label' => 'Название',
            ])
            ->add('vendorCode', TextType::class, [
                'label' => 'Артикул',
            ])
            ->add('description', TextType::class, [
                'label' => 'Описание',
            ])
            ->add('category', null, [
                'label' => 'Категория',
                'class' => Category::class,
            ])
            ->add('firm', null, [
                'label' => 'Фирма',
                'class' => Firm::class,
            ])
//            ->add('picture', null, [ // так вроде бы можно вывести текущее изображение
//                'template' => 'adminPhoto.html.twig',
//                'mapped' => false,
//            ])
            ->add('photos', CollectionType::class, [
                'by_reference' => true,
                'label' => 'Фото',
                'required' => false,
            ],
            [
                'edit' => 'inline',
                'inline' => 'table',
                'admin_code' => 'admin.photo',
                'type_options' => ['delete' => true],
                'btn_add' => 'Добавить фото',
            ])
            ->add('colors', null, [
                'label' => 'Цвета',
                'class' => Color::class,
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
                'label' => 'Название',
            ])
            ->add('vendorCode', null, [
                'label' => 'Артикул',
            ])
            ->add('description', null, [
                'label' => 'Описание',
            ])
            ->add('updatedAt', null, [
                'label' => 'Обновлено',
            ])
            ->add('category', null, [
                'label' => 'Категория',
            ])
            ->add('firm', null, [
                'label' => 'Фирма',
            ])
            ->add('photos', null, [
                'label' => 'Фото',
            ])
            ->add('colors', null, [
                'label' => 'Цвета',
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
                'label' => 'Название',
            ])
            ->add('vendorCode', TextType::class, [
                'label' => 'Артикул',
            ])
            ->add('description', TextType::class, [
                'label' => 'Описание',
            ])
//            ->add('updatedAt', DateTimeType::class, [
//                'label' => 'Обновлён',
//            ])
            ->add('category', TextType::class, [
                'label' => 'Категория',
            ])
            ->add('firm', TextType::class, [
                'label' => 'Фирма',
            ])
            ->add('photos', CollectionType::class, [
                'label' => 'Фото',
            ])
            ->add('colors', TextType::class, [
                'label' => 'Цвета',
            ]);
    }
}
