<?php
/**
 * Created by PhpStorm.
 * User: remim
 * Date: 24/01/2018
 * Time: 16:32
 */

namespace Sy\TutoBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TutorialAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('fullVisibility', BooleanType::class, [
                'label' => 'Visible à tout le monde (Si la case est cochée, 
                tout le monde pourra voir le tuto, sinon seule la classe le pourra.)',
//                'required' => false
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
            ->add('categories');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->add('content')
            ->add('fullVisibility')
            ->add('categories');
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $instance->setAuthor($user);

        return $instance;
    }
}