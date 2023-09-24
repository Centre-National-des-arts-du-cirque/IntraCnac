<?php

namespace App\Form\Ticket;

use App\Entity\BuildingTicket;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuildingTicketFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextType::class)
        ->add('description',TextareaType::class)

        ->add('Localisation',ChoiceType::class,[
            'choices' => [
                'Cirque Historique' =>'Cirque Historique',
                'Ecole national superieur du cirque' =>'Ecole national superieur du cirque'
            ],
        ])
            
            ->add('site')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BuildingTicket::class,
        ]);
    }
}
