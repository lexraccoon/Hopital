<?php

namespace App\Entity;

use App\Repository\ChambresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambresRepository::class)
 */
class Chambres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumeroChambre;

    /**
     * @ORM\Column(type="boolean", options={"default" : 1})
     */
    private $Disponibilite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroChambre(): ?int
    {
        return $this->NumeroChambre;
    }

    public function setNumeroChambre(int $NumeroChambre): self
    {
        $this->NumeroChambre = $NumeroChambre;

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
