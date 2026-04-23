<?php

namespace models;

use DateTime;

class Artist
{
    public function __construct(private string $name, private string $genre, private DateTime $activePeriod = new DateTime(), private ?string $bio, private ?int $id=null)
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function getActivePeriod(): DateTime
    {
        return $this->activePeriod;
    }

    public function setActivePeriod(DateTime $activePeriod): void
    {
        $this->activePeriod = $activePeriod;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): void
    {
        $this->bio = $bio;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}