<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Prestation;
use App\Repository\UserRepository;
use App\Repository\PrestationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("destinataire", EntityType::class, [
                "label" => "Quel est le destinataire de votre message",
                'class' => Prestation::class,
                'query_builder' => function (PrestationRepository $prestationRepo) {
                    return $prestationRepo->findOneById(1)->getId();
                },
                'choice_label' => "id"
            ])


            ->add('sujet', TextType::class, ["label" => "saisir le sujet de votre message", "attr" => ['placeholder' => "Sujet de votre message"]])
            ->add('contenu', TextareaType::class, ['label' => "saisir le contenu du message que vous souhaitez envoyer", "attr" => ['placeholder' => "contenu de votre message"]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
