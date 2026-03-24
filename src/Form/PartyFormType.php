<?php

namespace App\Form;

use App\Entity\Party;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class PartyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du groupe',
                'constraints' => [new NotBlank(message: 'Le nom est obligatoire')],
            ])
            ->add('description', TextareaType::class, [
                'label'    => 'Description',
                'required' => false,
            ])
            ->add('maxSize', IntegerType::class, [
                'label' => 'Taille maximum',
                'attr'  => ['min' => 1, 'max' => 20],
                'constraints' => [new Range(min: 1, max: 20)],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Party::class,
        ]);
    }
}
