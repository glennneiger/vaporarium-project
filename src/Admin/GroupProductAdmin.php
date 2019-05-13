<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class GroupProductAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('discount')
            ->add('description')
            ->add('publishInCategory',CheckboxType::class,['required'=> false ])
            ->add('publishIsTop',CheckboxType::class,['required'=> false ])
            ->add('publishInStock',CheckboxType::class,['required'=> false ])

        ;

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('discount')
            ->addIdentifier('description')
            ->addIdentifier('publishInCategory')
            ->addIdentifier('publishIsTop')
            ->addIdentifier('publishInStock')
        ;
    }

}