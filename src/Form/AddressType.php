<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => "Quel nom souhaitez vous donner à votre adresse ?",
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : Domicile'
                ]
            ])
            ->add('firstname', TextType::class,[
                'label' => "Prenom",
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre prenom'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => "Nom",
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Nom'
                ]
            ])
            ->add('company', TextType::class,[
                'label' => "Entreprise (Facultatif)",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex : SARL Rails et Freres'
                ]
            ])
            ->add('address', TextType::class,[
                'label' => "Adresse postale",
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : 16 rue des Ruby'
                    ]
                ])
            ->add('postal', TextType::class,[
                'label' => "Code Postal",
                'required' => true,
                'attr' => [
                    'placeholder' => '34000'
                    ]
                ])
            ->add('city', TextType::class,[
                'label' => "Ville",
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : Montpellier'
                    ]
                ])
            ->add('country', CountryType::class,[
                'label' => "Pays",
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : France'
                    ]
                ])
            ->add('phone', TelType::class,[
                'label' => "Telephone",
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex : 0687809523'
                    ]
                ])
            ->add('submit', SubmitType::class,[
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
