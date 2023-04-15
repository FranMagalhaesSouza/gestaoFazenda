<?php

namespace App\Entity;

use App\Repository\ProducaoLeiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProducaoLeiteRepository::class)]
class ProducaoLeite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $qntdLeite = null;

    #[ORM\ManyToOne(inversedBy: 'producaoLeites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dtInicial = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dtFinal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQntdLeite(): ?float
    {
        return $this->qntdLeite;
    }

    public function setQntdLeite(float $qntdLeite): self
    {
        $this->qntdLeite = $qntdLeite;

        return $this;
    }


    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getDtInicial(): ?\DateTimeInterface
    {
        return $this->dtInicial;
    }

    public function setDtInicial(\DateTimeInterface $dtInicial): self
    {
        $this->dtInicial = $dtInicial;

        return $this;
    }

    public function getDtFinal(): ?\DateTimeInterface
    {
        return $this->dtFinal;
    }

    public function setDtFinal(\DateTimeInterface $dtFinal): self
    {
        $this->dtFinal = $dtFinal;

        return $this;
    }
}
