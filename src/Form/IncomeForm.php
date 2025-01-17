<?php

namespace App\Form;

use App\Entity\Income;
use App\Entity\Period;
use Proxies\__CG__\App\Entity\Dictionary\IncomeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IncomeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'plannedValue',
                MoneyType::class,
                [
                    'label' => 'Planowany wydatek',
                    'currency' => 'PLN'
                ]
            )
            ->add(
                'realValue',
                MoneyType::class,
                [
                    'label' => 'Realny wydatek',
                    'currency' => 'PLN'
                ]
            )
            ->add(
                'incomeType',
                EntityType::class,
                [
                    'class' => IncomeType::class,
                    'label' => 'Typ przychodów',
                ]
            )
            ->add(
                'period',
                EntityType::class,
                [
                    'class' => Period::class,
                    'label' => 'Okres'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Income::class,
        ]);
    }
}
