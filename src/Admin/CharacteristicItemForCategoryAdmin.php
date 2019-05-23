<?php

namespace App\Admin;


use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class CharacteristicItemForCategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('characteristicProduct',
                SuggestType::class,
                ['suggester' => 'characteristicProduct'])
        ;
    }
}