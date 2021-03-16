<?php

namespace App\Entity;

use App\Repository\RDVRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RDVRepository::class)
 */
class RDV
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
    private $DateRDV;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureRDV;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatRDV;

    /**
     * @ORM\Column(type="string", options={"default" : "Demandé"}, length=255)
     */
    private $NomMedecin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomMedecin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomPatient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomPatient;

    /**
     * @ORM\Column(type="bigint")
     */
    private $NumeroDeSecuPatient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRDV(): ?\DateTimeInterface
    {
        return $this->DateRDV;
    }

    public function setDateRDV(\DateTimeInterface $DateRDV): self
    {
        $this->DateRDV = $DateRDV;

        return $this;
    }

    public function getHeureRDV(): ?\DateTimeInterface
    {
        return $this->HeureRDV;
    }

    public function setHeureRDV(\DateTimeInterface $HeureRDV): self
    {
        $this->HeureRDV = $HeureRDV;

        return $this;
    }

    public function getEtatRDV(): ?string
    {
        return $this->EtatRDV;
    }

    public function setEtatRDV(string $EtatRDV): self
    {
        $this->EtatRDV = $EtatRDV;

        return $this;
    }

    public function getNomMedecin(): ?string
    {
        return $this->NomMedecin;
    }

    public function setNomMedecin(string $NomMedecin): self
    {
        $this->NomMedecin = $NomMedecin;

        return $this;
    }

    public function getPrenomMedecin(): ?string
    {
        return $this->PrenomMedecin;
    }

    public function setPrenomMedecin(string $PrenomMedecin): self
    {
        $this->PrenomMedecin = $PrenomMedecin;

        return $this;
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

    public function getNumeroDeSecuPatient(): ?string
    {
        return $this->NumeroDeSecuPatient;
    }

    public function setNumeroDeSecuPatient(string $NumeroDeSecuPatient): self
    {
        $this->NumeroDeSecuPatient = $NumeroDeSecuPatient;

        return $this;
    }
}
