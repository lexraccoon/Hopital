<?php

namespace App\Entity;

use App\Repository\LitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LitRepository::class)
 */
class Lit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumeroLit;

    /**
     * @ORM\Column(type="boolean", options={"default" : 1})
     */
    private $Disponibilite;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDisponibilite(): ?bool
    {
        return $this->Disponibilite;
    }

    public function setDisponibilite(bool $Disponibilite): self
    {
        $this->Disponibilite = $Disponibilite;

        return $this;
    }

}
