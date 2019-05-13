<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',null, array('label'=>'Ваше имя'))
            ->add('lastName',null, array('label'=>'Ваша фамилия'))
            ->add('phone',null, array('label'=>'Ваш номер телефона'))
            ->add('email', EmailType::class, array('label'=>'Ваш Email','required' => false))
            ->add('comment', null, array('label'=>'Ваш коментарий','required' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
