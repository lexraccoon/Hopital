<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomPatient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomPatient;

    /**
     * @ORM\Column(type="integer")
     */
    private $AgePatient;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumeroDeChambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Service;

    /**
     * @ORM\Column(type="date")
     */
    private $DateEntree;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateSortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPatient(): ?string
    {
        return $this->NomPatient;
    }

    public function setNomPatient(string $NomPatient): self
    {
        $this->NomPatient = $NomPatient;

        return $this;
    }

    public function getPrenomPatient(): ?string
    {
        return $this->PrenomPatient;
    }

    public function setPrenomPatient(string $PrenomPatient): self
    {
        $this->PrenomPatient = $PrenomPatient;

        return $this;
    }

    public function getAgePatient(): ?int
    {
        return $this->AgePatient;
    }

    public function setAgePatient(int $AgePatient): self
    {
        $this->AgePatient = $AgePatient;

        return $this;
    }

    public function getNumeroDeChambre(): ?int
    {
        return $this->NumeroDeChambre;
    }

    public function setNumeroDeChambre(int $NumeroDeChambre): self
    {
        $this->NumeroDeChambre = $NumeroDeChambre;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->Service;
    }

    public function setService(string $Service): self
    {
        $this->Service = $Service;

        return $this;
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
}
