<?php

namespace managers;

use managers\AbstractManager;
use models\Artist;
use PDO;

class ArtistManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createArtist(Artist $artist): bool
    {
        $query = $this->db->prepare("INSERT INTO artists (id, name, genre, created_at, bio) VALUES (NULL, :name, :genre, :created_at, :bio)");
        $parameters = [
            ':name' => $artist->getName(),
            ':genre' => $artist->getGenre(),
            ':created_at' => $artist->getCreatedAt(),
            ':bio' => $artist->getBio()
        ];
        $query->execute($parameters);
        if ($this->db->lastInsertId()) {
            return true;
        }
        return false;
    }

    public function findOne(int $id) : ?Artist
    {
        $query = $this->db->prepare("SELECT * FROM artists WHERE id = :id");
        $parameters = [
            ':id' => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $artist = new Artist($result['name'], $result['genre'], $result['created_at'], $result['bio'], $result['id']);
            return $artist;
        }
        return null;
    }

    public function findAll() : array
    {
        $query = $this->db->prepare("SELECT * FROM artists");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $artists = [];
        foreach ($results as $result) {
            $artist = new Artist($result['name'], $result['genre'], $result['created_at'], $result['bio'], $result['id']);
            $artists[] = $artist;
        }
        return $artists;
    }

    public function updateArtist(Artist $artist): bool
    {
        $query = $this->db->prepare("UPDATE artists SET name = :name, genre = :genre, created_at = :created_at, bio = :bio WHERE id = :id");
        $parameters = [
            ':name' => $artist->getName(),
            ':genre' => $artist->getGenre(),
            ':created_at' => $artist->getCreatedAt(),
            ':bio' => $artist->getBio(),
            ':id' => $artist->getId()
        ];
        $query->execute($parameters);
        return true;
    }

    public function deleteArtist(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM artists WHERE id = :id");
        $parameters = [
            ':id' => $id
        ];
        $query->execute($parameters);
        return true;
    }
}