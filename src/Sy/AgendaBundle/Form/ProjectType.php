<?php

namespace Sy\AgendaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('group', EntityType::class, [
                'class' => 'SyMainBundle:GroupClass',
                'choices' => $options['groups'],
                'label' => 'Groupe'
            ])
            ->add('course', EntityType::class, [
                        'class' => 'SyMainBundle:Course',
                        'label' => 'Cours'
                    ])
            ->add('description', TextareaType::class)
            ->add('date', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter'
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sy\AgendaBundle\Entity\Project',
            'groups' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sy_agendabundle_project';
    }


}
