<?php
/**
 * Created by PhpStorm.
 * User: remim
 * Date: 10/01/2018
 * Time: 14:07
 */

namespace Sy\AgendaBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('group', EntityType::class, [
                'class' => 'SyMainBundle:GroupClass',
                'label' => 'Groupe'
            ])
            ->add('course', EntityType::class, [
                'class' => 'SyMainBundle:Course',
                'label' => 'Cours'
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('description', TextType::class);

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('course')
            ->add('date')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('course')
            ->add('date')
            ->add('description');
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $instance->setAuthor($user);

        return $instance;
    }
}