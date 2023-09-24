<?php

namespace App\Form\Ticket;

use App\Entity\ItTicket;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ErrorType;

class ItTicketFormType extends AbstractType
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
