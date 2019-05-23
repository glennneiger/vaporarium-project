<?php

namespace App\Admin;


use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class CharacteristicItemForProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('productCharacteristic',
                SuggestType::class,
                ['suggester' => 'characteristicProduct'])
            ->add('characteristicValue',
                SuggestType::class,
                ['suggester' => 'characteristicValueProduct'])
        ;
    }
}