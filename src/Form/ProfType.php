<?php

namespace App\Form;

use App\Entity\Prof;
use App\Entity\Matiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ProfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Le nom du prof',
                'required' => true
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Le prénom du prof',
                'required' => true
            ])
            ->add('datedenaissance', BirthdayType::class, [
                'label' => 'La date de naissance du prof',
                'required' => true
            ])
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'nom',
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer !'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prof::class,
        ]);
    }
}
