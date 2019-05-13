<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Sonata\CoreBundle\Form\Type\CollectionType;

class ProductAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('category')
            ->add('shortDescription')
            ->add('description')
            ->add('characteristics')
            ->add('price')
            ->add('comments')
            ->add('youTube')
            ->add('residue')
            ->add('group')
            ->add('imageFile',VichImageType::class, ['required'=> false ])
            ->add('productImage',
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
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('price')
            ->addIdentifier('residue')
            ->add('views')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('price')
        ;
    }

}