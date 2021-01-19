<?php

namespace App\Form;

use App\Entity\Prestation;
use App\Entity\PrestationType;
use App\Entity\PrestationStatut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PrestationTypes extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbheure', IntegerType::class, ['label' => 'Nombre d\'heure'])
            ->add('type', EntityType::class, ['label' => "De quelle prestation avez-vous besoin", 'class' => PrestationType::class, 'choice_label' => "nom"])
            ->add("endat", DateType::class, [
                'label' => "à quelle datte la prestation doit avoir lieu", 'widget' => 'single_text',
            ])
            ->add('instruction', TextareaType::class, ['label' => "Instruction concernant la prestation", 'required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
