<?php

namespace App\Entity;

use App\Repository\SejourPatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SejourPatientRepository::class)
 */
class SejourPatient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $DateEntree;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateSortie;

    /**
     * @ORM\Column(type="integer")
     */
    public $IdPatient;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumeroLit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomService;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->DateEntree;
    }

    public function setDateEntree(\DateTimeInterface $DateEntree): self
    {
        $this->DateEntree = $DateEntree;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->DateSortie;
    }

    public function setDateSortie(?\DateTimeInterface $DateSortie): self
    {
        $this->DateSortie = $DateSortie;

        return $this;
    }

    public function getIdPatient(): ?int
    {
        return $this->IdPatient;
    }

    public function setIdPatient(int $IdPatient): self
    {
        $this->IdPatient = $IdPatient;

        return $this;
    }

    public function getNumeroLit(): ?int
    {
        return $this->NumeroLit;
    }

    public function setNumeroLit(int $NumeroLit): self
    {
        $this->NumeroLit = $NumeroLit;

        return $this;
    }

    public function getNomService(): ?string
    {
        return $this->NomService;
    }

    public function setNomService(string $NomService): self
    {
        $this->NomService = $NomService;

        return $this;
    }
}
