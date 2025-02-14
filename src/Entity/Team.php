<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idowner = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_team = null;

    #[ORM\Column]
    private ?int $nb_joueurs = null;

    #[ORM\OneToMany(mappedBy: 'idTeam', targetEntity: Classement::class)]
    private Collection $classements;

    #[ORM\OneToMany(mappedBy: 'idTeam', targetEntity: Membre::class)]
    private Collection $membres;

    public function __construct()
    {
        $this->classements = new ArrayCollection();
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdowner(): ?int
    {
        return $this->idowner;
    }

    public function setIdowner(int $idowner): self
    {
        $this->idowner = $idowner;

        return $this;
    }

    public function getNomTeam(): ?string
    {
        return $this->nom_team;
    }

    public function setNomTeam(string $nom_team): self
    {
        $this->nom_team = $nom_team;

        return $this;
    }

    public function getNbJoueurs(): ?int
    {
        return $this->nb_joueurs;
    }

    public function setNbJoueurs(int $nb_joueurs): self
    {
        $this->nb_joueurs = $nb_joueurs;

        return $this;
    }

    /**
     * @return Collection<int, Classement>
     */
    public function getClassements(): Collection
    {
        return $this->classements;
    }

    public function addClassement(Classement $classement): self
    {
        if (!$this->classements->contains($classement)) {
            $this->classements->add($classement);
            $classement->setIdTeam($this);
        }

        return $this;
    }

    public function removeClassement(Classement $classement): self
    {
        if ($this->classements->removeElement($classement)) {
            // set the owning side to null (unless already changed)
            if ($classement->getIdTeam() === $this) {
                $classement->setIdTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membre $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
            $membre->setIdTeam($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getIdTeam() === $this) {
                $membre->setIdTeam(null);
            }
        }

        return $this;
    }
}
