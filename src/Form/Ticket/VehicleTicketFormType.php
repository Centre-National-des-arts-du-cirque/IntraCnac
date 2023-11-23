<?php

namespace App\Form\Ticket;

use App\Entity\VehicleTicket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class VehicleTicketFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('immatriculation', TextType::class, [
                'required' => true,
                'constraints' => [new Regex([
                    'pattern' => '/^([A-HJ-NP-TV-Z]{2}[\s-]{0,1}[0-9]{3}[\s-]{0,1}[A-HJ-NP-TV-Z]{2}|[0-9]{2,4}[\s-]{0,1}[A-Z]{1,3}[\s-]{0,1}[0-9]{2})$/',
                    'message' => "L'immatriculation dois etre au format XX-000-XX ou 0000-XXX-00",
                    ])],
            ])
            ->add('brand', ChoiceType::class, [
                'choices' => [
                    'Berlingot' => 'Berlingot',
                    'Megane' => 'Megane',
                    'Citroën' => 'Citroën',
                    'Dacia' => 'Dacia',
                    'Citroen' => 'Citroen',
                    'Iveco' => 'Iveco',
                    'Renault' => 'Renault',
                    ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VehicleTicket::class,
        ]);
    }
}
