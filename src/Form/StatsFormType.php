<?php

namespace App\Form;

use App\Entity\Show;
use App\Entity\Stats;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Season')
            ->add('Episode')
            ->add('Time_stamp')
            ->add('TV_show',EntityType::class,[
                'class'=>Show::class,
                'property_path'=>'TV_show'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stats::class,
        ]);
    }
}
