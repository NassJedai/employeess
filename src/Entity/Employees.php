<?php

namespace App\Entity;

use App\Repository\EmployeesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeesRepository::class)]
class Employees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $hireDate = null;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: Demands::class)]
    private Collection $demands;


    //#[ORM\ManyToOne(inversedBy: 'employee')]
    //#[ORM\JoinColumn(nullable: true)]
    //private ?Salaries $salaries = null;


    //#[ORM\ManyToOne(inversedBy: 'employee')]
    //#[ORM\JoinColumn(nullable: false)]
   // private ?DeptManager $deptManager = null;

   // #[ORM\ManyToOne(inversedBy: 'employee')]
   // #[ORM\JoinColumn(nullable: false)]
    //private ?DeptEmp $deptEmp = null;

    //#[ORM\ManyToOne(inversedBy: 'employee')]
    //#[ORM\JoinColumn(nullable: false)]
   // private ?Titles $titles = null;

    public function __construct()
    {
        $this->demands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getHireDate(): ?\DateTimeInterface
    {
        return $this->hireDate;
    }

    public function setHireDate(\DateTimeInterface $hireDate): self
    {
        $this->hireDate = $hireDate;

        return $this;
    }

    /**
     * @return Collection<int, Demands>
     */
    public function getDemands(): Collection
    {
        return $this->demands;
    }

    public function addDemand(Demands $demand): self
    {
        if (!$this->demands->contains($demand)) {
            $this->demands->add($demand);
            $demand->setEmployee($this);
        }

        return $this;
    }

    public function removeDemand(Demands $demand): self
    {
        if ($this->demands->removeElement($demand)) {
            // set the owning side to null (unless already changed)
            if ($demand->getEmployee() === $this) {
                $demand->setEmployee(null);
            }
        }

        return $this;
    }

    public function getSalaries(): ?Salaries
    {
        return $this->salaries;
    }

    public function setSalaries(?Salaries $salaries): self
    {
        $this->salaries = $salaries;

        return $this;
    }

    public function getDeptManager(): ?DeptManager
    {
        return $this->deptManager;
    }

    public function setDeptManager(?DeptManager $deptManager): self
    {
        $this->deptManager = $deptManager;

        return $this;
    }

    public function getDeptEmp(): ?DeptEmp
    {
        return $this->deptEmp;
    }

    public function setDeptEmp(?DeptEmp $deptEmp): self
    {
        $this->deptEmp = $deptEmp;

        return $this;
    }

    public function getTitles(): ?Titles
    {
        return $this->titles;
    }

    public function setTitles(?Titles $titles): self
    {
        $this->titles = $titles;

        return $this;
    }
}
