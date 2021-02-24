<?php

namespace App\Form;

use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeTypes extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('user', EntityType::class, [
            'placeholder' => "type de la prestation",
            'label' => "De quelle type de prestation avez-vous besoin", 'class' => Demande::class, 'choice_label' => "name"
        ])


        ->add('cv')
            ->add('motivation')
            ->add('specialite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
