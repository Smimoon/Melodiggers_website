<?php

namespace managers;

use managers\AbstractManager;
use models\Album;
use PDO;

class AlbumManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createAlbum(Album $album) : bool
    {
        $query = $this->db->prepare("INSERT INTO albums (id, name, genre, tracklist, release_date,) VALUES (NULL, :name, :genre, :tracklist, :release_date)");
        $parameters = [
            "name" => $album->getName(),
            "genre" => $album->getGenre(),
            "tracklist" => $album->getTrackList(),
            "release_date" => $album->getReleaseDate()
        ];
        $query->execute($parameters);
        if ($this->db->lastInsertId()) {
            return true;
        }
        return false;
    }

    public function findOne(int $id): ?Album
    {
        $query = $this->db->prepare("SELECT * FROM albums WHERE id = :id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $album = new Album($result['name'], $result['genre'], $result['tracklist'], $result['release_date'], $result['id']);
            return $album;
        }
        return null;
    }

    public function findAll() : array
    {
        $query = $this->db->prepare("SELECT * FROM albums");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $albums = [];
        foreach ($results as $result) {
            $album= new Album($result['name'], $result['genre'], $result['tracklist'], $result['release_date'], $result['id']);
            $albums[] = $album;
        }
        return $albums;
    }

    public function updateAlbum(Album $album) : bool
    {
        $query = $this->db->prepare("UPDATE albums SET name = :name, genre = :genre, tracklist = :tracklist, release_date = :release_date  WHERE id = :id");
        $parameters = [
            "name" => $album->getName(),
            "genre" => $album->getGenre(),
            "tracklist" => $album->getTrackList(),
            "release_date" => $album->getReleaseDate(),
            "id" => $album->getId()
        ];
        $query->execute($parameters);
        if ($this->db->lastInsertId()) {
            return true;
        }
        return false;
    }

    public function deleteAlbum(int $id) : bool
    {
        $query = $this->db->prepare("DELETE FROM albums WHERE id = :id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        return true;
    }
}