<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\CharacterCLass;
use App\Entity\Race;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class CharacterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du personnage',
                'constraints' => [new NotBlank(message: 'Le nom est obligatoire')],
            ])
            ->add('id_Race', EntityType::class, [
                'class'        => Race::class,
                'choice_label' => 'name',
                'label'        => 'Race',
            ])
            ->add('class_id', EntityType::class, [
                'class'        => CharacterCLass::class,
                'choice_label' => 'name',
                'label'        => 'Classe',
            ])
            ->add('STR', IntegerType::class, [
                'label' => 'Force (STR)',
                'attr'  => ['min' => 8, 'max' => 15],
                'data'  => 8,
                'constraints' => [new Range(min: 8, max: 15)],
            ])
            ->add('DEX', IntegerType::class, [
                'label' => 'Dextérité (DEX)',
                'attr'  => ['min' => 8, 'max' => 15],
                'data'  => 8,
                'constraints' => [new Range(min: 8, max: 15)],
            ])
            ->add('CON', IntegerType::class, [
                'label' => 'Constitution (CON)',
                'attr'  => ['min' => 8, 'max' => 15],
                'data'  => 8,
                'constraints' => [new Range(min: 8, max: 15)],
            ])
            ->add('INT', IntegerType::class, [
                'label' => 'Intelligence (INT)',
                'attr'  => ['min' => 8, 'max' => 15],
                'data'  => 8,
                'constraints' => [new Range(min: 8, max: 15)],
            ])
            ->add('WIS', IntegerType::class, [
                'label' => 'Sagesse (WIS)',
                'attr'  => ['min' => 8, 'max' => 15],
                'data'  => 8,
                'constraints' => [new Range(min: 8, max: 15)],
            ])
            ->add('CHA', IntegerType::class, [
                'label' => 'Charisme (CHA)',
                'attr'  => ['min' => 8, 'max' => 15],
                'data'  => 8,
                'constraints' => [new Range(min: 8, max: 15)],
            ])
            ->add('imageFile', FileType::class, [
                'label'    => 'Image (avatar)',
                'mapped'   => false,
                'required' => false,
                'constraints' => [
                    new File(
                        maxSize: '2M',
                        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
                        mimeTypesMessage: 'Format accepté : JPG, PNG, WEBP',
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
