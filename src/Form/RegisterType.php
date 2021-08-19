<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', TextType::class, [
                'label' => 'Votre Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 40
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre Prenom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 40
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prenom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 40
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre adresse email' 
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
                'label' => 'Votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe', 
                    'attr' => [
                        'placeholder' => 'Saisissez votre mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe', 
                    'attr' => [
                        'placeholder' => 'Saisissez à nouveau votre mot de passe'
                    ]
                ],
                
            ])
            // ->add('password_confirm', PasswordType::class, [
            //     'label' => 'Confirmez mot de passe',
            //     'mapped' => false,
            //     'attr' => [
            //         'placeholder' => 'Confirmez votre mot de passe'
            //     ]
            // ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
