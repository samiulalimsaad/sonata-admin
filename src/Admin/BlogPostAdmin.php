<?php

namespace App\Admin;

use App\Entity\BlogPost;
use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class BlogPostAdmin extends AbstractAdmin
{

    protected function configureDashboardActions(array $actions): array
    {
        $actions = parent::configureDashboardActions($actions);
        dump($actions);
        return $actions;
    }

    // public function configureExportFields(AdminInterface $admin, array $fields): array
    // {
    //     // Export specific fields
    //     dump($fields);
    //     return $fields;
    // }

    public function getExportFormats(): array
    {
        return ['csv', 'xml', 'json'];
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->tab('Post')
            ->with('Content', ['class' => 'col-md-9'])
            ->add('title', TextType::class)
            ->add('body', TextareaType::class)
            // ->add('body', ChoiceFieldMaskType::class, [
            //     'choices' => [
            //         'title' => 'title',
            //         'draft' => 'draft',
            //     ],
            //     'map' => [
            //         'draft' => ['title', 'draft'],
            //         'title' => ['draft'],
            //     ],
            //     'placeholder' => 'Choose an option',
            //     'required' => false
            // ])
            ->end()
            ->end()
            ->tab('Publish Options')
            ->with('Meta Data', ['class' => 'col-md-3'])
            ->add('draft', BooleanType::class)
            ->add('category', ModelAutocompleteType::class, [
                'class' => Category::class,
                'property' => 'name'
            ])
            ->end()
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add(
                'title',
                null,
                [
                    'field_type' => EntityType::class,
                    'field_options' => [
                        'class' => BlogPost::class,
                        'choice_label' => 'title'
                    ]
                ]
            )
            ->add('body')
            ->add('draft')
            ->add(
                'category',
                null,
                [
                    'field_type' => EntityType::class,
                    'field_options' => [
                        'class' => Category::class,
                        'choice_label' => 'name'
                    ]
                ]
            );
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('title')
            ->addIdentifier('body')
            ->addIdentifier('draft')
            ->add('category', Category::class);
    }


    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            // ->add('id')
            // ->add('title')
            // ->add('body')
            // ->add('draft')
            // ->add('category.name');
            // ->tab('Post')
            ->with('Content', ['class' => 'col-md-9'])
            ->add('title')
            ->add('body')
            ->end()
            // ->end()
            // ->tab('Publish Options')
            ->with('Meta Data', ['class' => 'col-md-3'])
            ->add('draft')
            ->add('category.name')
            // ->end()
            ->end();
    }
}
