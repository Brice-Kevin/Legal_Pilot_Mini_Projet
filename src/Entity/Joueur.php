<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueurRepository::class)
 */
class Joueur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $full_name;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $current_club;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nationality;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appearances_home;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appearances_away;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goals_home;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goals_away;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assists_home;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assists_away;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $equipe_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCurrentClub(): ?string
    {
        return $this->current_club;
    }

    public function setCurrentClub(?string $current_club): self
    {
        $this->current_club = $current_club;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getAppearancesHome(): ?int
    {
        return $this->appearances_home;
    }

    public function setAppearancesHome(?int $appearances_home): self
    {
        $this->appearances_home = $appearances_home;

        return $this;
    }

    public function getAppearancesAway(): ?int
    {
        return $this->appearances_away;
    }

    public function setAppearancesAway(?int $appearances_away): self
    {
        $this->appearances_away = $appearances_away;

        return $this;
    }

    public function getGoalsHome(): ?int
    {
        return $this->goals_home;
    }

    public function setGoalsHome(?int $goals_home): self
    {
        $this->goals_home = $goals_home;

        return $this;
    }

    public function getGoalsAway(): ?int
    {
        return $this->goals_away;
    }

    public function setGoalsAway(?int $goals_away): self
    {
        $this->goals_away = $goals_away;

        return $this;
    }

    public function getAssistsHome(): ?int
    {
        return $this->assists_home;
    }

    public function setAssistsHome(?int $assists_home): self
    {
        $this->assists_home = $assists_home;

        return $this;
    }

    public function getAssistsAway(): ?int
    {
        return $this->assists_away;
    }

    public function setAssistsAway(?int $assists_away): self
    {
        $this->assists_away = $assists_away;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getEquipeId(): ?int
    {
        return $this->equipe_id;
    }

    public function setEquipeId(int $equipe_id): self
    {
        $this->equipe_id = $equipe_id;

        return $this;
    }
}
