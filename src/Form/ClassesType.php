<?php

namespace App\Form;

use App\Entity\Prof;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Le nom de la classe',
                'required' => true
            ])
            ->add('niveau', TextType::class, [
                'label' => 'Le niveau de la classe',
                'required' => true
            ])
            ->add('prof', EntityType::class, [
                'class' => Prof::class,
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
            'data_class' => Classe::class,
        ]);
    }
}
