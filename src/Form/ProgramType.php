<?php

namespace App\Form;

use App\Entity\Program;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('summary', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('poster', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('category', null, [
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],])
            ->add('country', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('year', IntegerType::class, [
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
