<?php

namespace App\Entity;

use App\Entity\Dictionary\ExpenseType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlannedExpenseRepository")
 */
class PlannedExpense extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dictionary\ExpenseType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expenseType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Period", inversedBy="plannedExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $period;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getExpenseType(): ?ExpenseType
    {
        return $this->expenseType;
    }

    public function setExpenseType(?ExpenseType $expenseType): self
    {
        $this->expenseType = $expenseType;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }
}
