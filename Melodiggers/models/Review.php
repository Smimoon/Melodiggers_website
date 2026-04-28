<?php

namespace models;

use DateTime;

class Review
{
    public function __construct(private User $user, private Album $album, private string $title, private string $content, private DateTime $created_at = new DateTime(), private ?int $id = null)
    {

    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getAlbum(): Album
    {
        return $this->album;
    }

    public function setAlbum(Album $album): void
    {
        $this->album = $album;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->created_at = $createdAt;
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