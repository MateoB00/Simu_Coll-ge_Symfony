<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Le nom de l\'élève',
                'required' => true
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Le prénom de l\'élève',
                'required' => true
            ])
            ->add('datedenaissance', BirthdayType::class, [
                'label' => 'La date de naissance de l\'élève',
                'required' => true
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'nom',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer !'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
