<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Prestation;
use App\Entity\PrestationType;
use App\Entity\PrestationStatut;
use App\Form\PrestationInstructionFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PrestationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbheure', IntegerType::class, ['label' => 'Nombre d\'heure'])
            ->add('user', entityType::class, ['class' => User::class, 'choice_label' => "firstname"])
            ->add('type', entityType::class, ['class' => PrestationType::class,  'choice_label' => "nom"])
            ->add('statut', entityType::class, ['class' => PrestationStatut::class,  'choice_label' => "nom"])
            ->add('instruction', PrestationInstructionFormType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
