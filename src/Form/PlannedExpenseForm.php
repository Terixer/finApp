<?php

namespace App\Form;

use App\Entity\Dictionary\ExpenseType;
use App\Entity\Period;
use App\Entity\PlannedExpense;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlannedExpenseForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'value',
                MoneyType::class,
                [
                    'label' => 'Wartość',
                    'currency' => 'PLN'
                ]
            )
            ->add(
                'expenseType',
                EntityType::class,
                [
                    'class' => ExpenseType::class,
                    'label' => 'Typ wydatków',
                ]
            )
            ->add(
                'period',
                EntityType::class,
                [
                    'class' => Period::class,
                    'label' => 'Okres',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlannedExpense::class,
        ]);
    }
}
