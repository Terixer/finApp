<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\GoalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Goal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Minimalna wartość to {{ limit }}%",
     *      maxMessage = "Maksymalna wartość to {{ limit }}%",
     *      notInRangeMessage = "Wartość procentowa powinna być pomiędzy {{ min }}%,a {{ max }}%."
     * )
     */
    private $percentage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $effectiveDate;

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps(): void
    {
        $this->effectiveDate = new \DateTime("now");
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    public function setPercentage(int $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getEffectiveDate(): ?\DateTimeInterface
    {
        return $this->effectiveDate;
    }

    public function setEffectiveDate(\DateTimeInterface $effectiveDate): self
    {
        $this->effectiveDate = $effectiveDate;

        return $this;
    }
}
