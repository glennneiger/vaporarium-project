<?php

namespace App\Admin;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Sonata\CoreBundle\Form\Type\CollectionType;

class CategoryAdmin extends AbstractAdmin
{
    protected $datagridValues=[
        '_sort_order' => 'ASC',
        '_sort_by' => 'left'
    ];

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('publish',CheckboxType::class,['required'=> false ])
            ->add('parent')
            ->add('description')
            ->add('imageFileCategory',VichImageType::class, ['required'=> false ])
            ->add('fonRGB')
            ->add('imageFileCategoryFon',VichImageType::class, ['required'=> false ])
            ->add('characteristicItemForCategory',
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
            ->addIdentifier('id', null, ['sortable'=>false])
            ->addIdentifier('name', null, ['sortable'=>false, 'template'=>'admin/category/fields/name.html.twig'])
            ->addIdentifier('publish')
            ->add('parent', null, ['sortable'=>false])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('parent');
    }

    public function postPersist($object)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository(Category::class);
        $repo->verify();
        $repo->recover();
        $em->flush();
    }

    public function postUpdate($object)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository(Category::class);
        $repo->verify();
        $repo->recover();
        $em->flush();
    }

}
