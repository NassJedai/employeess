<?php

namespace App\Entity;

use App\Repository\DepartementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementsRepository::class)]
class Departements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\ManyToOne(inversedBy: 'departement')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DeptManager $deptManager = null;

    #[ORM\OneToMany(mappedBy: 'departement', targetEntity: DeptEmp::class)]
    private Collection $deptEmps;

    public function __construct()
    {
        $this->deptEmps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    /**
     * @return Collection<int, DeptEmp>
     */
    public function getDeptEmps(): Collection
    {
        return $this->deptEmps;
    }

    public function addDeptEmp(DeptEmp $deptEmp): self
    {
        if (!$this->deptEmps->contains($deptEmp)) {
            $this->deptEmps->add($deptEmp);
            $deptEmp->setDepartement($this);
        }

        return $this;
    }

    public function removeDeptEmp(DeptEmp $deptEmp): self
    {
        if ($this->deptEmps->removeElement($deptEmp)) {
            // set the owning side to null (unless already changed)
            if ($deptEmp->getDepartement() === $this) {
                $deptEmp->setDepartement(null);
            }
        }

        return $this;
    }
}
