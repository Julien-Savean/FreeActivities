<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('description')
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
                'html5' => false,
                // this is actually the default format for single_text
                'format' => 'dd-MMMM-yyyy',
            ])
            ->add('picture', TextType::class, [
                'label' => 'Image',
            ])
            ->add('capacity', TextType::class, [
                'label' => 'Capacité',
            ])
            ->add('sport', null, ['choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
