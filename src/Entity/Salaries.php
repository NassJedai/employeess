<?php

namespace App\Entity;

use App\Repository\SalariesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalariesRepository::class)]
class Salaries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $salary = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $toDate = null;

    #[ORM\OneToMany(mappedBy: 'salaries', targetEntity: Employees::class)]
    private Collection $employee;

    public function __construct()
    {
        $this->employee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * @return Collection<int, Employees>
     */
    public function getEmployee(): Collection
    {
        return $this->employee;
    }

    public function addEmployee(Employees $employee): self
    {
        if (!$this->employee->contains($employee)) {
            $this->employee->add($employee);
            $employee->setSalaries($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employee->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getSalaries() === $this) {
                $employee->setSalaries(null);
            }
        }

        return $this;
    }
}
