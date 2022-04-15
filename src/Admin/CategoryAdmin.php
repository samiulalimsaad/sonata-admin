<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{

    protected function configureDashboardActions(array $actions): array
    {
        $actions = parent::configureDashboardActions($actions);
        dump($actions);
        return $actions;
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        // Removing the export option.
        $collection
            ->remove('export')
            // ->remove('create')
            ->remove('edit');
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('name', TextType::class, [
            'label' => 'Category name',
            'required' => true,
        ], [
            'type' => FieldDescriptionInterface::TYPE_TIME
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('id')
            ->add('name');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name');
    }
}
