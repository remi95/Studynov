<?php
/**
 * Created by PhpStorm.
 * User: remim
 * Date: 24/01/2018
 * Time: 16:32
 */

namespace Sy\TutoBundle\Admin;


use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TutorialAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class)
            ->add('content', CKEditorType::class, [
                'config' => [
                    'filebrowserBrowseRoute' => 'elfinder',
                    'filebrowserBrowseRouteParameters' => [
                        'instance' => 'default',
                        'homeFolder' => ''
                        ]
                    ]
                ])
            ->add('fullVisibility', CheckboxType::class, [
                'label' => 'Visible à tout le monde (Si la case est cochée, 
                tout le monde pourra voir le tuto, sinon seule la classe le pourra.)',
                'required' => false
            ])
            ->add('groups', EntityType::class, [
                'class' => 'SyMainBundle:GroupClass',
                'label' => 'Groupes',
                'multiple' => true
            ])
            ->add('categories', EntityType::class, [
                'class' => 'SyMainBundle:Category',
                'label' => 'Catégories',
                'multiple' => true
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title')
            ->add('content')
            ->add('fullVisibility')
            ->add('categories')
            ->add('groups');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->add('date')
            ->add('editDate')
            ->add('fullVisibility')
            ->add('categories')
            ->add('groups');
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $instance->setAuthor($user);

        return $instance;
    }
}