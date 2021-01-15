<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Prestation;
use App\Entity\PrestationType;
use App\Entity\PrestationStatut;
use App\Form\PrestationInstructionTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PrestationTypes extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbheure', IntegerType::class, ['label' => 'Nombre d\'heure'])
            ->add('user', EntityType::class, ['class' => User::class, 'choice_label' => "firstname"])
            ->add('type', entityType::class, ['class' => PrestationType::class,  'choice_label' => "nom"])
            ->add('statut', entityType::class, ['class' => PrestationStatut::class,  'choice_label' => "nom"])
            ->add('instruction', PrestationInstructionTypes::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
