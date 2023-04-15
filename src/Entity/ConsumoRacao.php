<?php

namespace App\Entity;

use App\Repository\ConsumoRacaoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsumoRacaoRepository::class)]
class ConsumoRacao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive(message:"O campo deve conter valores positivo")]
    #[Assert\NotNull]
    private ?float $qtdRacao = null;

    #[ORM\ManyToOne(inversedBy: 'consumoRacaos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull]
    private ?\DateTimeInterface $dtInicial = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull]
    private ?\DateTimeInterface $dtFinal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQtdRacao(): ?float
    {
        return $this->qtdRacao;
    }

    public function setQtdRacao(float $qtdRacao): self
    {
        $this->qtdRacao = $qtdRacao;

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
