<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lib',TextType::class , options:[
                'empty_data' => '',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('DateBeg',DateType::class , options:[
                'label' => 'Choisir une date',
                'widget' => 'single_text',
                'html5' => false,
                'data' => new \DateTime(),
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'js-datepicker'],
                ])
            ->add('DateEnd',DateType::class,options:[
                'label' => 'Choisir une date',
                'widget' => 'single_text',
                'html5' => false,
                'data' => new \DateTime(),
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'js-datepicker2'],

            ])
            ->add('TypeEvent', EntityType::class,[
                'class'=>'App\Entity\TypeEvent',
                'choice_label'=>'lib',
                'multiple'=>false,
                'expanded'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
