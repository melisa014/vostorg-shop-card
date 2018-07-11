<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class)
            ->add('vendorCode', TextType::class)
            ->add('description', TextType::class)
            ->add('price', TextType::class)
//            ->add('updatedAt', TextType::class)
            ->add('category', ChoiceType::class)
            ->add('firm', ChoiceType::class)
            ->add('photos', TextType::class)
            ->add('colors', ChoiceType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')
            ->add('vendorCode')
            ->add('description')
            ->add('price')
//            ->add('updatedAt')
            ->add('category')
            ->add('firm')
            ->add('photos')
            ->add('colors');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
            ->add('vendorCode')
            ->add('description')
            ->add('price')
//            ->add('updatedAt')
            ->add('category')
            ->add('firm')
            ->add('photos')
            ->add('colors');
    }
}
