<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', TextareaType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Stress out here!'
            ]
        ])->add('save', SubmitType::class, [
            'label' => 'Share With Community'
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data-class' => Secret::class]);
    }
}