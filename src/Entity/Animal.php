<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $qntdLeite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $qntdRacao = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 3)]
    private ?string $peso = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dtNasc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQntdLeite(): ?string
    {
        return $this->qntdLeite;
    }

    public function setQntdLeite(string $qntdLeite): self
    {
        $this->qntdLeite = $qntdLeite;

        return $this;
    }

    public function getQntdRacao(): ?string
    {
        return $this->qntdRacao;
    }

    public function setQntdRacao(string $qntdRacao): self
    {
        $this->qntdRacao = $qntdRacao;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(string $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getDtNasc(): ?\DateTimeInterface
    {
        return $this->dtNasc;
    }

    public function setDtNasc(\DateTimeInterface $dtNasc): self
    {
        $this->dtNasc = $dtNasc;

        return $this;
    }
}
