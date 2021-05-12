<?php

namespace App\Form;

use App\Entity\Realisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('url')
            ->add('git')
            ->add('imgs')
            ->add('text', TextareaType::class)
            ->add('type', ChoiceType::class,[
                'choices' => [
                    'wysiwyg' => 'wysiwyg',
                    'game'=> 'game',
                    'webapp'=> 'webapp'
                ],
            ])
            ->add('techs', ChoiceType::class,[
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'react' => 'react',
                    'symfony' => 'symfony',
                    'vanillajs' => 'vanillajs',
                    'php' => 'php',
                    'socketio' => 'socketio',
                    'nodejs' => 'nodejs'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
