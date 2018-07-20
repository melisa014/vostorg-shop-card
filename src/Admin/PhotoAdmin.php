<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
        $formMapper
//            ->add('file', FileType::class, [
//            'required' => false,
//            'label' => 'sdgs11',
//        ])
        ->add('photoDescription', TextType::class, [
            'attr' => [
                'placeholder' => 'Введите описание фото',
            ],
            'label' => false,
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
        $listMapper
//            ->add('file', FileType::class, [
//            'label' => 'sdgs',
//        ])
        ->add('photoDescription', TextType::class, [
            'attr' => [
                'placeholder' => 'Введите описание фото',
            ],
            'label' => false,
        ]);
    }

    public function prePersist($photo)
    {
        $this->saveFile($photo);
    }

    public function preUpdate($photo)
    {
        $this->saveFile($photo);
    }

    public function saveFile($photo)
    {
        $basepath = $this->getRequest()->getBasePath();

        $entityName = '';
        $firmName = '';

        if (!empty($this->getFirm())) {
            $entityName = 'firm';
        } elseif (!empty($this->getProduct())) {
            $entityName = 'product';
            $firmName = $this->getProduct()->getFirm()->getName();
        }

        $photo->upload($basepath, $entityName, $firmName);
    }
}
