<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class CharacteristicValueAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('value')
            ->add('valueForAdmin');
    }
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('value')
            ->addIdentifier('valueForAdmin')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('characteristic')
        ;
    }

}