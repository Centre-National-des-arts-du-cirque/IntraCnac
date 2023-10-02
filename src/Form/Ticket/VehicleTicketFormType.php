<?php

namespace App\Form\Ticket;

use App\Entity\VehicleTicket;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class VehicleTicketFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('immatriculation', TextType::class)
            ->add('brand', ChoiceType::class, [
                'choices' => [

                    'Berlingot' => 'Berlingot',
                    'Megane' => 'Megane',
                    'Citroën' => 'Citroën',
                    'Dacia' => 'Dacia',
                    "Citroen" => "Citroen",
                    'Iveco' => 'Iveco',
                    'Renault' => 'Renault',
                    ]
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
