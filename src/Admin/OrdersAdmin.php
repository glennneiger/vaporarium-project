<?php

namespace App\Admin;


use App\Entity\Order;
use Doctrine\ORM\QueryBuilder;
use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrdersAdmin extends AbstractAdmin
{

    private $statusLabels = [
       // 'В корзине' =>Order::STATUS_DRUFT,
        'Заказан' =>Order::STATUS_ORDERED,
        'Отправлен' =>Order::STATUS_SENT,
        'Закрыт' =>Order::STATUS_DONE,
    ];

    protected  $datagridValues  =  [
    '_sort_order'  =>  'DESC'
    ];


    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('payment_status')
            ->add('firstName')
            ->add('lastName')
            ->add('user', SuggestType::class,
                ['required'=>false,
                'suggester'=>'user',
                'attr' => ['class'=>'form-control']
                ])
            ->add('phone')
            ->add('email')
            ->add('comment')
            ->add('status', ChoiceType::class, [
                'choices' =>$this->statusLabels,
            ])
            ->add('orderItems',
                CollectionType::class,
                ['by_reference'=>false],
                [
                'edit'=>'inline',
                'inline'=>'table'
                ])
            ->add('order_price',
                null,
                ['attr'=>[
                    'readonly'=>'1',
                    'class'=>'js-order-orderprice'
                ]]);

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id')
            ->add('date')
            ->addIdentifier('status', 'choice', [
                'choices' =>array_flip($this->statusLabels),
            ])
            ->addIdentifier('phone')
            ->addIdentifier('fistName')
            ->addIdentifier('lastName')
            ->addIdentifier('email')
            ->addIdentifier('comment')
            ->addIdentifier('payment_status')
         //   ->add('orderitems', null, ['associated_property'=>'product'])
            ->add('orderItems', null, ['template'=>'admin/Order/Fields/orderitems.html.twig'])
            ->add('order_price')
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('date')
            ->add('status', 'doctrine_orm_choice', [
                'field_type'=>ChoiceType::class,
                'field_options'=>[
                    'choices'=>$this->statusLabels],
            ])
            ->add('phone')
            ->add('email')
            ->add('comment')
            ->add('payment_status')
            ->add('order_price');
    }

    public function createQuery($context = 'list')
    {
        /**
         * @var QueryBuilder $query
         */
        $query = parent::createQuery($context);
        list($rootAlias) =$query->getRootAliases();
        $query->andWhere($rootAlias.'.status > 0');
        $query->leftJoin($rootAlias.'.orderItems', 'i')->addSelect('i');
        $query->leftJoin('i.product', 'p')->addSelect('p');
        return $query;

    }


}