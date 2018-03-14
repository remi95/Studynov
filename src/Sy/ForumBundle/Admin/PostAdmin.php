<?php

namespace Sy\ForumBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('content', CKEditorType::class, [
                'config' => [
                    'filebrowserBrowseRoute' => 'elfinder',
                    'filebrowserBrowseRouteParameters' => [
                        'instance' => 'default',
                        'homeFolder' => ''
                    ]
                ]
            ])
            ->add('categories', EntityType::class, [
                'class' => 'SyMainBundle:Category',
                'label' => 'Catégories',
                'multiple' => true,
            ])
            ->add('tuto', EntityType::class, [
                'class' => 'SyTutoBundle:Tutorial',
                'label' => 'Rattacher à un tutoriel',
                'required' => false,
            ])
            ->add('project', EntityType::class, [
                'class' => 'SyAgendaBundle:Project',
                'label' => 'Rattacher à un projet de cours',
                'required' => false,
            ]);

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title')
            ->add('date')
            ->add('author')
            ->add('categories')
            ->add('tuto')
            ->add('project');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->add('date')
            ->add('author')
            ->add('categories')
            ->add('tuto')
            ->add('project');
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $instance->setAuthor($user);

        return $instance;
    }
}