<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $NomPatient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $PrenomPatient;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDeNaissance;

    /**
     * @ORM\Column(type="bigint")
     */
    private $NumeroDeSecu;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdUtilisateur;

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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

        return $this;
    }

    public function getNumeroDeSecu(): ?string
    {
        return $this->NumeroDeSecu;
    }

    public function setNumeroDeSecu(string $NumeroDeSecu): self
    {
        $this->NumeroDeSecu = $NumeroDeSecu;

        return $this;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->IdUtilisateur;
    }

    public function setIdUtilisateur(int $IdUtilisateur): self
    {
        $this->IdUtilisateur = $IdUtilisateur;

        return $this;
    }
}
