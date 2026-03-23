<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $STR = null;

    #[ORM\Column]
    private ?int $DEX = null;

    #[ORM\Column]
    private ?int $CON = null;

    #[ORM\Column]
    private ?int $INT = null;

    #[ORM\Column]
    private ?int $WIS = null;

    #[ORM\Column]
    private ?int $CHA = null;

    #[ORM\Column]
    private ?int $HitPoints = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_User = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $id_Race = null;

    /**
     * @var Collection<int, Party>
     */
    #[ORM\ManyToMany(targetEntity: Party::class, mappedBy: 'characters')]
    private Collection $parties;

    #[ORM\ManyToOne(inversedBy: 'char_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CharacterCLass $class_id = null;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getSTR(): ?int
    {
        return $this->STR;
    }

    public function setSTR(int $STR): static
    {
        $this->STR = $STR;

        return $this;
    }

    public function getDEX(): ?int
    {
        return $this->DEX;
    }

    public function setDEX(int $DEX): static
    {
        $this->DEX = $DEX;

        return $this;
    }

    public function getCON(): ?int
    {
        return $this->CON;
    }

    public function setCON(int $CON): static
    {
        $this->CON = $CON;

        return $this;
    }

    public function getINT(): ?int
    {
        return $this->INT;
    }

    public function setINT(int $INT): static
    {
        $this->INT = $INT;

        return $this;
    }

    public function getWIS(): ?int
    {
        return $this->WIS;
    }

    public function setWIS(int $WIS): static
    {
        $this->WIS = $WIS;

        return $this;
    }

    public function getCHA(): ?int
    {
        return $this->CHA;
    }

    public function setCHA(int $CHA): static
    {
        $this->CHA = $CHA;

        return $this;
    }

    public function getHitPoints(): ?int
    {
        return $this->HitPoints;
    }

    public function setHitPoints(int $HitPoints): static
    {
        $this->HitPoints = $HitPoints;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_User;
    }

    public function setIdUser(?User $id_User): static
    {
        $this->id_User = $id_User;

        return $this;
    }

    public function getIdRace(): ?Race
    {
        return $this->id_Race;
    }

    public function setIdRace(?Race $id_Race): static
    {
        $this->id_Race = $id_Race;

        return $this;
    }

    /**
     * @return Collection<int, Party>
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Party $party): static
    {
        if (!$this->parties->contains($party)) {
            $this->parties->add($party);
            $party->addCharacter($this);
        }

        return $this;
    }

    public function removeParty(Party $party): static
    {
        if ($this->parties->removeElement($party)) {
            $party->removeCharacter($this);
        }

        return $this;
    }

    public function getClassId(): ?CharacterCLass
    {
        return $this->class_id;
    }

    public function setClassId(?CharacterCLass $class_id): static
    {
        $this->class_id = $class_id;

        return $this;
    }
}
