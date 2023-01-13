<?php

namespace App\Entity;

use App\Repository\TitlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TitlesRepository::class)]
class Titles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'titles', targetEntity: Employees::class)]
    private Collection $employee;

    public function __construct()
    {
        $this->employee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
            $employee->setTitles($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employee->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getTitles() === $this) {
                $employee->setTitles(null);
            }
        }

        return $this;
    }
}
