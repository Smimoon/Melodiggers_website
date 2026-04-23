<?php

namespace models;

class Album
{
    public function __construct(private string $name, private string $genre, private DateTime $releaseDate = new DateTime(), private string $trackList, private ?int $id = null)
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

    public function getReleaseDate(): DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(DateTime $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getTrackList(): string
    {
        return $this->trackList;
    }

    public function setTrackList(string $trackList): void
    {
        $this->trackList = $trackList;
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