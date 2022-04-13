<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class BlogPostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->tab('Post')
            ->with('Content', ['class' => 'col-md-9'])
            ->add('title', TextType::class)
            ->add('body', TextareaType::class)
            ->end()
            ->end()
            ->tab('Publish Options')
            ->with('Meta Data', ['class' => 'col-md-3'])
            ->add('draft', BooleanType::class)
            ->add('category', ModelType::class, [
                'class' => Category::class,
                'property' => 'name'
            ])
            ->end()
            ->end();
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('title')
            ->add('body')
            ->add('draft')
            ->add('category', Category::class);
    }


    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('title')
            ->add('body')
            ->add('draft')
            ->add('category', Category::class);
    }
}
