<?php

namespace models;

class Score
{
    public function __construct(private Album $album, private int $globalScore, private int $fanScore, private ?int $id = null )
    {

    }

    public function getGlobalScore(): int
    {
        return $this->globalScore;
    }

    public function setGlobalScore(int $globalScore): void
    {
        $this->globalScore = $globalScore;
    }

    public function getFanScore(): int
    {
        return $this->fanScore;
    }

    public function setFanScore(int $fanScore): void
    {
        $this->fanScore = $fanScore;
    }

public function getAlbum(): Album
    {
        return $this->album;
    }

    public function setAlbumId(Album $album): void
    {
        $this->album = $album;
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