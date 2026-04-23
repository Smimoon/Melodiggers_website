<?php

namespace models;

class Score
{
    private function __construct(private int $globalScore, private int $fanScore, private int $albumId, private ?int $id = null )
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

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function setAlbumId(int $albumId): void
    {
        $this->albumId = $albumId;
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