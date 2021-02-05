<?php

namespace App\Form;

use DateTime;
use App\Entity\Prestation;
use App\Entity\PrestationType;
use App\Entity\PrestationStatut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PrestationTypes extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbheure', IntegerType::class, [
                'attr' => ['placeholder' => "Durée de la prestation"],
                'label' => 'Durant combien de temps la prestation doit avoir lieu'
            ])

            ->add('type', EntityType::class, [
                'placeholder' => "type de la prestation",
                'label' => "De quelle type de prestation avez-vous besoin", 'class' => PrestationType::class, 'choice_label' => "nom"
            ])

            ->add("endat", DateType::class, [
                'label' => "à quelle datte la prestation doit avoir lieu",
                'widget' => 'single_text',
            ])

            ->add(
                'address',
                TextType::class,
                [
                    'attr' => ['placeholder' => "Adresse ou doit avoir lieu la prestation"],
                    'label' => 'Adresse où la prestation doit se dérouler'
                ]
            )

            ->add(
                'postalCode',
                NumberType::class,
                [
                    'attr' => ['placeholder' => "code postal"],
                    'label' => 'Code postal'
                ]
            )

            ->add(
                'city',
                TextType::class,
                [
                    'attr' => ['placeholder' => "Saisir la ville lié à l'adresse indiquer"],
                    'label' => 'Ville'
                ]
            )

            ->add('instruction', TextareaType::class, [
                'attr' => ['placeholder' => "Saisir un commentaire si vous le souhaitez afin de facilité la prestation"],
                'label' => "Instruction concernant la prestation", 'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
