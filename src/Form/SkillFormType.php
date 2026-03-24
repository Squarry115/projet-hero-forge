<?php

namespace App\Form;

use App\Entity\CharacterCLass;
use App\Entity\Skill;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SkillFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [new NotBlank()],
            ])
            ->add('ability', ChoiceType::class, [
                'label' => 'Caractéristique associée',
                'choices' => [
                    'Force'        => 'STR',
                    'Dextérité'    => 'DEX',
                    'Constitution' => 'CON',
                    'Intelligence' => 'INT',
                    'Sagesse'      => 'WIS',
                    'Charisme'     => 'CHA',
                ],
            ])
            ->add('id_class', EntityType::class, [
                'class'        => CharacterCLass::class,
                'choice_label' => 'name',
                'label'        => 'Classe associée',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Skill::class]);
    }
}
