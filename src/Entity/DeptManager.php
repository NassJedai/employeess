<?php

namespace App\Entity;

use App\Repository\DeptManagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeptManagerRepository::class)]
class DeptManager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fromDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $toDate = null;

    #[ORM\OneToMany(mappedBy: 'deptManager', targetEntity: Departements::class)]
    private Collection $departement;

    #[ORM\OneToMany(mappedBy: 'deptManager', targetEntity: Employees::class)]
    private Collection $employee;

    public function __construct()
    {
        $this->departement = new ArrayCollection();
        $this->employee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTimeInterface $fromDate): self
    {
        $this->fromDate = $fromDate;

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
     * @return Collection<int, Departements>
     */
    public function getDepartement(): Collection
    {
        return $this->departement;
    }

    public function addDepartement(Departements $departement): self
    {
        if (!$this->departement->contains($departement)) {
            $this->departement->add($departement);
            $departement->setDeptManager($this);
        }

        return $this;
    }

    public function removeDepartement(Departements $departement): self
    {
        if ($this->departement->removeElement($departement)) {
            // set the owning side to null (unless already changed)
            if ($departement->getDeptManager() === $this) {
                $departement->setDeptManager(null);
            }
        }

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
            $employee->setDeptManager($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employee->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getDeptManager() === $this) {
                $employee->setDeptManager(null);
            }
        }

        return $this;
    }
}
