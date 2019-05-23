<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;

class ProductCharacteristicAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('searchName')
            ->add('characteristicValue',
                CollectionType::class,
                ['by_reference'=>false],
                [
                    'edit'=>'inline',
                    'inline'=>'table'
                ])
        ;

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
        ;
    }

}