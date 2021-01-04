<?php

namespace App\Form;

use App\Entity\User;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Benevol' => 'ROLE_VOLONTEER',
                    'Gestionnaire' => 'ROLE_AGENT',
                    'Administrateurr' => 'ROLE_ADMIN',

                ],

                'expanded' => false,
                'multiple' => true,
                //'choice_label' => ,
                //'choice_value' => ,
                'label' => 'Rôles',
            ])
            ->add('createdAt', DateTimeType::class, [
                'disabled' => true,
                'label' => 'Created (not editable)',
            ])

            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address')
            ->add('postalcode', NumberType::class)
            ->add('city', CountryType::class)
            ->add('phone', TelType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'help' => 'Enter your password',
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
