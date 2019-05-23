<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;


class QuestionAdmin extends AbstractAdmin
{
    protected  $datagridValues  =  [
        '_sort_order'  =>  'DESC'
    ];

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('email')
            ->add('number')
            ->add('question')
        ;

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->addIdentifier('email')
            ->addIdentifier('number')
            ->addIdentifier('question')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('email')
            ->add('number')
            ->add('question')
        ;
    }


}