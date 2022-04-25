<?php

namespace App\Admin;

use App\Enum\GenderEnum;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

final class CategoryAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            // ->add('id')
            ->add('name')
            ->add('type', EnumType::class, [
                'class' => GenderEnum::class
                // 'choices' => GenderEnum::cases(),
                // 'choices' => [
                //     GenderEnum::MALE->value => GenderEnum::MALE->name,
                //     GenderEnum::FEMALE->value => GenderEnum::FEMALE->name,
                //     GenderEnum::ALL->value => GenderEnum::ALL->name,
                // ]
                // 'choices' => [
                //     'Male' => 'Male',
                //     'Female' => 'Female',
                //     'All' => 'All',
                // ]
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('type', 'enum');
    }
}
