<?php

namespace Sy\TutoBundle\Form;


use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
                'label' => 'Titre du tutoriel : '
            ])
            ->add('content', CKEditorType::class, [
                'config' => [
                    'filebrowserBrowseRoute' => 'elfinder',
                    'filebrowserBrowseRouteParameters' => [
                        'instance' => 'default',
                        'homeFolder' => ''
                    ]
                ],
                'label' => 'Contenu'
            ])
            ->add('fullVisibility', CheckboxType::class,[
                'label' => 'Visible à tout le monde (Si "non" seuls les groupes sélectionnés pourront le voir.)',
                    'required' => false
            ])
            ->add('groups', EntityType::class, [
                'class' => 'SyMainBundle:GroupClass',
                'choices' => $options['groups'],
                'label' => 'Groupes',
                'multiple' => true,
                'required' => false,
            ])
            ->add('categories', EntityType::class, [
                    'class' => 'SyMainBundle:Category',
                    'label' => 'Catégories : ',
                    'multiple' => true
            ])
            ->add('Valider', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sy\TutoBundle\Entity\Tutorial',
            'groups' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sy_tutobundle_tutorial';
    }


}
