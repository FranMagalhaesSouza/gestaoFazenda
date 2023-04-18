<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 3)]
    #[Assert\NotNull]
    #[Assert\Positive(message:"O campo deve conter valores positivo")]
    private ?string $peso = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull]
    private ?\DateTimeInterface $dtNasc = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 5,
        max: 250,
        minMessage: 'A Descrição deve conter no minimo {{ limit }} caracteres',
        maxMessage: 'A Descrição deve conter no maximo {{ limit }} caracteres',
    )]
    private ?string $descricao = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?float $qtdleite = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?float $qtdracao = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dtabate = null;
   
    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getQtdleite(): ?float
    {
        return $this->qtdleite;
    }

    public function setQtdleite(float $qtdleite): self
    {
        $this->qtdleite = $qtdleite;

        return $this;
    }

    public function getQtdracao(): ?float
    {
        return $this->qtdracao;
    }

    public function setQtdracao(float $qtdracao): self
    {
        $this->qtdracao = $qtdracao;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDtabate(): ?\DateTimeInterface
    {
        return $this->dtabate;
    }

    public function setDtabate(?\DateTimeInterface $dtabate): self
    {
        $this->dtabate = $dtabate;

        return $this;
    }
}
