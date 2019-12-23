<?php

namespace App\Entity;

use App\Entity\Dictionary\IncomeType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncomeRepository")
 */
class Income extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dictionary\IncomeType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incomeType;

    /**
     * @ORM\Column(type="float")
     */
    private $plannedValue;

    /**
     * @ORM\Column(type="float")
     */
    private $realValue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Period", inversedBy="incomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $period;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIncomeType(): ?IncomeType
    {
        return $this->incomeType;
    }

    public function setIncomeType(?IncomeType $incomeType): self
    {
        $this->incomeType = $incomeType;

        return $this;
    }

    public function getPlannedValue(): ?float
    {
        return $this->plannedValue;
    }

    public function setPlannedValue(float $plannedValue): self
    {
        $this->plannedValue = $plannedValue;

        return $this;
    }

    public function getRealValue(): ?float
    {
        return $this->realValue;
    }

    public function setRealValue(float $realValue): self
    {
        $this->realValue = $realValue;

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
