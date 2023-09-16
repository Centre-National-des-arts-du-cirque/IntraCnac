<?php

namespace App\Form;

use App\Entity\ItTicket;
use Composer\Semver\Constraint\Constraint;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ItTickerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'constraint ' => [
                    new NotBlank([
                        'message' => 'Veuillez mettre un titre a votre ticket',
                    ]),
                ]
            ])
            ->add('description',TextType::class,[
                'constraint ' => [
                    new NotBlank([
                        'message' => 'Veuillez mettre une description a votre ticket',
                    ]),
                ]
            ])

            ->add('pcName',TextType::class)
            ->add('errorCode',TextType::class)
            ->add('Localisation',ChoiceType::class,[
                'choices' => [
                    'Cirque Historique' =>'Cirque Historique',
                    'Ecole national superieur du cirque' =>'Ecole national superieur du cirque',
                ],
            ])
           
            ->add('ErrorType',EntityType::class,[
                'class' => ErrorType::class,
                'choice_label' => 'lib',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItTicket::class,
        ]);
    }
}
