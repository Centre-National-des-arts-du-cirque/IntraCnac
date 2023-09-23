<?php

namespace App\Form\Ticket;

use App\Entity\BuildingTicket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuildingTicketFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextType::class)
        ->add('description',TextType::class)

        ->add('pcName',TextType::class,[
            'required'=> false,
        ])
        ->add('errorCode',TextType::class,[
            'required'=> false,
        ])
        ->add('Localisation',ChoiceType::class,[
            'choices' => [
                'Cirque Historique' =>'Cirque Historique',
                'Ecole national superieur du cirque' =>'Ecole national superieur du cirque',
                'distanciel' =>'distanciel',
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
