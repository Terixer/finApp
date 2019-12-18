<?php

namespace App\Form;

use App\Entity\Period;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeriodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                ['label' => 'Nazwa']
            )
            ->add(
                'dateFrom',
                DateTimeType::class,
                ['label' => 'Okres od']
            )
            ->add(
                'dateTo',
                DateTimeType::class,
                ['label' => 'Okres do']
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Period::class,
        ]);
    }
}
