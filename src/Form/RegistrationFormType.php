<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('file', FileType::class, [
                'label' => 'Photo de profil',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Merci de choisir une image valide',
                    ]),
                    new NotBlank([
                        'message' => 'Merci de choisir une photo de profil',
                    ]),
                ],
                ],
            )

            ->add('name')
            ->add('lastname')
            ->add('post', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d entrer un poste',
                    ]),
                ],
            ])
            ->add('service', ChoiceType::class, [
                'choices' => [
                    'Administration' => 'Administration',
                    'Comptabilité' => 'Comptabilité',
                    'Batiment et infrastructure' => 'Batiment et infrastructure',
                    'Centre de ressources' => 'Centre de ressource',
                    'Communication' => 'Communication',
                    'Formations' => 'Formations',
                    'Autre' => 'Autre',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d entrer un service',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mot de passe devrai au moins contenir {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    ]),
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
