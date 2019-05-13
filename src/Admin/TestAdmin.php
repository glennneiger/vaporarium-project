<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Sonata\CoreBundle\Form\Type\CollectionType;

class TestAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('imageFileOne',VichImageType::class, ['required'=> false ])
            ->add('imageFileTwo',VichImageType::class, ['required'=> false ])
            ->add('imageFileThree',VichImageType::class, ['required'=> false ])
        ;

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
        ;
    }

}