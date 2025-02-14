<?php

namespace App\Entity;

use App\Repository\JeuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuxRepository::class)]
class Jeux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGame = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateAddGame = null;

    #[ORM\Column]
    private ?int $maxPlayers = null;

    #[ORM\Column]
    private ?float $priceGame = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'idJeux', targetEntity: News::class)]
    private Collection $news;

    #[ORM\OneToMany(mappedBy: 'idJeux', targetEntity: ReviewJeux::class)]
    private Collection $reviewJeuxes;

    public function __construct()
    {
        $this->news = new ArrayCollection();
        $this->reviewJeuxes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGame(): ?string
    {
        return $this->nomGame;
    }

    public function setNomGame(string $nomGame): self
    {
        $this->nomGame = $nomGame;

        return $this;
    }

    public function getDateAddGame(): ?\DateTimeInterface
    {
        return $this->DateAddGame;
    }

    public function setDateAddGame(\DateTimeInterface $DateAddGame): self
    {
        $this->DateAddGame = $DateAddGame;

        return $this;
    }

    public function getMaxPlayers(): ?int
    {
        return $this->maxPlayers;
    }

    public function setMaxPlayers(int $maxPlayers): self
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    public function getPriceGame(): ?float
    {
        return $this->priceGame;
    }

    public function setPriceGame(float $priceGame): self
    {
        $this->priceGame = $priceGame;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, News>
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news->add($news);
            $news->setIdJeux($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->removeElement($news)) {
            // set the owning side to null (unless already changed)
            if ($news->getIdJeux() === $this) {
                $news->setIdJeux(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReviewJeux>
     */
    public function getReviewJeuxes(): Collection
    {
        return $this->reviewJeuxes;
    }

    public function addReviewJeux(ReviewJeux $reviewJeux): self
    {
        if (!$this->reviewJeuxes->contains($reviewJeux)) {
            $this->reviewJeuxes->add($reviewJeux);
            $reviewJeux->setIdJeux($this);
        }

        return $this;
    }

    public function removeReviewJeux(ReviewJeux $reviewJeux): self
    {
        if ($this->reviewJeuxes->removeElement($reviewJeux)) {
            // set the owning side to null (unless already changed)
            if ($reviewJeux->getIdJeux() === $this) {
                $reviewJeux->setIdJeux(null);
            }
        }

        return $this;
    }
}
