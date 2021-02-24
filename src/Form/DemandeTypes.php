<?php

namespace App\Form;

use App\Entity\PrestationType;
use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeTypes extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specialite', EntityType::class, [
                "label" => "Dans quelle spécialité(s) êtes vous prêt à travailler",
                'class'    => PrestationType::class,
                'choice_label' => 'nom',
                'multiple' => true
            ])
            ->add('cv', TextareaType::class, ['label' => "Saisir votre parcour de vie durant les 5 dernières années", "attr" => ['placeholder' => "Votre CV"]])
            ->add('motivation', TextareaType::class, ["label" => "Rédiger en un text cours l'ensemble des éléments qui vous pousse à postuler chez nous, et pourquoi on devrais vous embaucher vous et pas un autre", "attr" => ['placeholder' => "Saisir votre motivation"]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
