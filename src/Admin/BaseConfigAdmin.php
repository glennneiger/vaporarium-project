<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Sonata\CoreBundle\Form\Type\CollectionType;

class BaseConfigAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('title')
            ->add('publish',CheckboxType::class,['required'=> false ])
            ->add('description')
            ->add('descriptionTwo')
            ->add('googleMapIframeSrc')
            ->add('title')
            ->add('description')
            ->add('descriptionTwo')
            ->add('googleMapIframeSrc')
            ->add('fromEmail')
            ->add('toEmail')
            ->add('names')
            ->add('fonRGB')
            ->add('imageFile',VichImageType::class, ['required'=> false ])
            ->add('imageBaseSlider',
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
            ->addIdentifier('title')
            ->addIdentifier('publish')
            ->addIdentifier('description')
        ;
    }

}