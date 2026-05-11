<?php

namespace managers;

use managers\AbstractManager;
use models\Artist;
use PDO;
use DateTime;

class ArtistManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createArtist(Artist $artist): bool
    {
        $query = $this->db->prepare("INSERT INTO artists (name, genre, bio, created_at) VALUES (:name, :genre, :bio, :created_at)");
        $parameters = [
            ':name' => $artist->getName(),
            ':genre' => $artist->getGenre(),
            ':bio' => $artist->getBio(),
            ':created_at' => $artist->getCreatedAt()->format('Y-m-d H:i:s')
        ];
        $query->execute($parameters);
        $id = $this -> db -> lastInsertId();
        $artist->setId($id);
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
            $artist = new Artist($result['name'], $result['genre'],  $result['bio'], DateTime::createFromFormat('Y-m-d H:i:s', $result["created_at"]), $result['id']);
            return $artist;
        }
        return null;
    }

    public function findAll() : array
    {
        $query = $this->db->prepare("SELECT * FROM artists ORDER BY id ASC");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $artists = [];
        foreach ($results as $result) {
            $artist = new Artist($result['name'], $result['genre'], $result['bio'], DateTime::createFromFormat('Y-m-d H:i:s', $result["created_at"]), $result['id']);
            $artists[] = $artist;
        }
        return $artists;
    }

    public function updateArtist(Artist $artist): bool
    {
        $query = $this->db->prepare("UPDATE artists SET name = :name, genre = :genre, bio = :bio, created_at = :created_at WHERE id = :id");
        $parameters = [
            ':name' => $artist->getName(),
            ':genre' => $artist->getGenre(),
            ':bio' => $artist->getBio(),
            ':created_at' => $artist->getCreatedAt()->format('Y-m-d H:i:s'),
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