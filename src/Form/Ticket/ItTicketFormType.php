<?php

namespace App\Form\Ticket;

use App\Entity\ErrorType;
use App\Entity\ItTicket;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItTicketFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)

            ->add('pcName', TextType::class, [
                'required' => false,
            ])
            ->add('errorCode', TextType::class, [
                'required' => false,
            ])
            ->add('Localisation', ChoiceType::class, [
                'choices' => [
                    'Cirque Historique' => 'Cirque Historique',
                    'Espace chapiteau 34av' => 'Espace chapiteau 34av',
                    'distanciel' => 'distanciel',
                ],
            ])

            ->add('ErrorType', EntityType::class, [
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
