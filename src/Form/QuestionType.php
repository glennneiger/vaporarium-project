<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, array('label'=>'Как к Вам обращаться','required' => true))
            ->add('email', EmailType::class, array('label'=>'Ваш Email','required' => false))
            ->add('number', null, array('label'=>'Ваш номер телефона','required' => true))
            ->add('question', null, array('label'=>'Какой вопрос Вас интересует?'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
