<?php
/**
 * Created by PhpStorm.
 * User: remim
 * Date: 28/03/2018
 * Time: 11:44
 */

namespace Sy\ForumBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class VoteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('vote', CheckboxType::class, [
            'required' => false,
        ])
            ->add('comment', EntityType::class, [
                'class' => 'SyForumBundle:Comment',
                'label' => 'Comment',
            ]);

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('vote')
            ->add('comment')
            ->add('user');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('vote')
            ->add('comment')
            ->add('user');
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $instance->setAuthor($user);

        return $instance;
    }
}