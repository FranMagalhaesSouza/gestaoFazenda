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

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: ConsumoRacao::class)]
    private Collection $consumoRacaos;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: ProducaoLeite::class)]
    private Collection $producaoLeites;

    

    public function __construct()
    {
        $this->consumoRacaos = new ArrayCollection();
        $this->producaoLeites = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ConsumoRacao>
     */
    public function getConsumoRacaos(): Collection
    {
        return $this->consumoRacaos;
    }

    public function addConsumoRacao(ConsumoRacao $consumoRacao): self
    {
        if (!$this->consumoRacaos->contains($consumoRacao)) {
            $this->consumoRacaos->add($consumoRacao);
            $consumoRacao->setAnimal($this);
        }

        return $this;
    }

    public function removeConsumoRacao(ConsumoRacao $consumoRacao): self
    {
        if ($this->consumoRacaos->removeElement($consumoRacao)) {
            // set the owning side to null (unless already changed)
            if ($consumoRacao->getAnimal() === $this) {
                $consumoRacao->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProducaoLeite>
     */
    public function getProducaoLeites(): Collection
    {
        return $this->producaoLeites;
    }

    public function addProducaoLeite(ProducaoLeite $producaoLeite): self
    {
        if (!$this->producaoLeites->contains($producaoLeite)) {
            $this->producaoLeites->add($producaoLeite);
            $producaoLeite->setAnimal($this);
        }

        return $this;
    }

    public function removeProducaoLeite(ProducaoLeite $producaoLeite): self
    {
        if ($this->producaoLeites->removeElement($producaoLeite)) {
            // set the owning side to null (unless already changed)
            if ($producaoLeite->getAnimal() === $this) {
                $producaoLeite->setAnimal(null);
            }
        }

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
}
