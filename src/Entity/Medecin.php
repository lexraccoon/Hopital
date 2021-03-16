<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedecinRepository::class)
 */
class Medecin
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
    private $NomMedecin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomMedecin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SpecialiteMedecin;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSpecialiteMedecin(): ?string
    {
        return $this->SpecialiteMedecin;
    }

    public function setSpecialiteMedecin(string $SpecialiteMedecin): self
    {
        $this->SpecialiteMedecin = $SpecialiteMedecin;

        return $this;
    }
}
