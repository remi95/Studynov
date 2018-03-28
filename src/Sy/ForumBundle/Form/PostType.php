<?php

namespace Sy\ForumBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
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
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sy\ForumBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sy_forumbundle_post';
    }


}
